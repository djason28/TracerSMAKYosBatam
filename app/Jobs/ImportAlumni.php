<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\AlumniImport;

class ImportAlumni implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $path;
    public string $jobId;
    public $timeout = 1200;
    public $backoff = [60, 120, 300];

    public function __construct(string $path, string $jobId)
    {
        $this->path  = $path;
        $this->jobId = $jobId;
    }

    public function handle()
    {
        $lockName = 'import-alumni-' . md5($this->path);
        $lock     = Cache::lock($lockName, 600);

        if (! $lock->get()) {
            \Log::warning("ImportAlumni: Gagal mendapat lock: $lockName");
            return;
        }

        try {
            \Log::info("ImportAlumni: Mulai import file: " . $this->path);
            $fullPath = Storage::path($this->path);

            if (! Storage::exists($this->path)) {
                \Log::error("ImportAlumni: File tidak ditemukan: " . $this->path);
                return;
            }

            // 1) Cek header: harus ada 'nis' & 'nama'
            $headingRows     = (new HeadingRowImport)->toArray($fullPath);
            $firstHeadingRow = $headingRows[0][0] ?? [];
            $normalizedHeadings = array_map(fn($h) => strtolower(trim($h)), $firstHeadingRow);

            \Log::info("ImportAlumni: normalizedHeadings = " . json_encode($normalizedHeadings));

            if (! in_array('nis',  $normalizedHeadings) ||
                ! in_array('nama', $normalizedHeadings)
            ) {
                \Log::error("ImportAlumni: Heading 'nis' atau 'nama' tidak ditemukan");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'missing_fields',
                    'duplicates' => [],
                    'imported'   => [],
                ], now()->addMinutes(10));
                return;
            }

            // 2) Header valid → jalankan import
            $importer = new AlumniImport();
            Excel::import($importer, $fullPath);

            \Log::info("ImportAlumni: Import selesai; createdCount="
                       . $importer->createdCount
                       . ", noData=" . ($importer->noData ? 'true' : 'false')
                       . ", invalidNis=" . ($importer->invalidNis ? 'true' : 'false')
                       . ", rowMissingField=" . ($importer->rowMissingField ? 'true' : 'false')
                       . ", duplicates=" . json_encode($importer->duplicateNis)
                       . ", imported=" . json_encode($importer->importedNis)
            );

            // 3) Cek rowMissingField (prioritas tertinggi setelah header valid)
            if ($importer->rowMissingField) {
                \Log::error("ImportAlumni: Ada baris yang tidak lengkap (nis atau nama kosong)");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'missing_fields',
                    'duplicates' => $importer->duplicateNis,
                    'imported'   => $importer->importedNis,
                ], now()->addMinutes(10));
                return;
            }

            // 4) Cek invalidNis
            if ($importer->invalidNis) {
                \Log::error("ImportAlumni: Ditemukan NIS tidak valid (bukan 4 digit angka)");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'invalid_nis',
                    'duplicates' => $importer->duplicateNis,
                    'imported'   => $importer->importedNis,
                ], now()->addMinutes(10));
                return;
            }

            // 5) Cek noData (header valid tapi tidak ada baris data)
            if ($importer->noData) {
                \Log::info("ImportAlumni: Header valid tapi tidak ada baris data");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'no_data_alumni',
                    'duplicates' => $importer->duplicateNis,
                    'imported'   => $importer->importedNis,
                ], now()->addMinutes(10));
                return;
            }

            // 6) Cek createdCount
            if ($importer->createdCount === 0) {
                // Semua row di‐Excel ternyata sudah ada di DB → hanya duplicate, tidak ada yang di‐create
                \Log::info("ImportAlumni: Semua data sudah ada → no_new_data_alumni");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'no_new_data_alumni',
                    'duplicates' => $importer->duplicateNis,
                    'imported'   => $importer->importedNis, // pasti kosong, tapi keep konsisten
                ], now()->addMinutes(10));
            } else {
                // Ada minimal satu record baru → set status = done
                \Log::info("ImportAlumni: Ada {$importer->createdCount} record baru → done");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'done',
                    'duplicates' => $importer->duplicateNis,
                    'imported'   => $importer->importedNis,
                ], now()->addMinutes(10));
            }

        } catch (\Throwable $e) {
            \Log::error("ImportAlumni error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            Cache::put("import-status:{$this->jobId}", [
                'status'     => 'import_failed',
                'duplicates' => [],
                'imported'   => [],
            ], now()->addMinutes(10));
        } finally {
            $lock->release();
            Storage::delete($this->path);
            \Log::info("ImportAlumni: Cleanup—unlock dan delete file " . $this->path);
        }
    }
}
