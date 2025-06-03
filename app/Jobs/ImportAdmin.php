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
use App\Imports\AdminImport;

class ImportAdmin implements ShouldQueue
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
        $lockName = 'import-admin-' . md5($this->path);
        $lock     = Cache::lock($lockName, 600);
        if (! $lock->get()) {
            \Log::warning("ImportAdmin: Gagal mendapat lock: $lockName");
            return;
        }

        try {
            \Log::info("ImportAdmin: Mulai import file: " . $this->path);
            $fullPath = Storage::path($this->path);

            if (! Storage::exists($this->path)) {
                \Log::error("ImportAdmin: File tidak ditemukan: " . $this->path);
                return;
            }

            // 1) Baca header
            $headingRows     = (new HeadingRowImport)->toArray($fullPath);
            $firstHeadingRow = $headingRows[0][0] ?? [];
            $normalizedHeadings = array_map(fn($h) => strtolower(trim($h)), $firstHeadingRow);

            \Log::info("ImportAdmin: normalizedHeadings = " . json_encode($normalizedHeadings));

            // 2) Cek kolom 'email' & 'nama'
            if (! in_array('email', $normalizedHeadings) ||
                ! in_array('nama',  $normalizedHeadings)
            ) {
                \Log::error("ImportAdmin: Heading 'email' atau 'nama' tidak ditemukan");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'missing_fields',
                    'duplicates' => [],
                    'imported'   => [],
                ], now()->addMinutes(10));
                return;
            }

            // 3) Panggil AdminImport
            $importer = new AdminImport();
            Excel::import($importer, $fullPath);

            \Log::info("ImportAdmin: Import selesai; createdCount="
                       . $importer->createdCount
                       . ", noData=" . ($importer->noData ? 'true' : 'false')
                       . ", invalidEmail=" . ($importer->invalidEmail ? 'true' : 'false')
                       . ", rowMissingField=" . ($importer->rowMissingField ? 'true' : 'false')
                       . ", duplicates=" . json_encode($importer->duplicateEmails)
                       . ", imported=" . json_encode($importer->importedEmails)
            );

            // 4) Cek rowMissingField (baris yang kosong email/nama)
            if ($importer->rowMissingField) {
                \Log::error("ImportAdmin: Ada baris yang tidak lengkap (email atau nama kosong)");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'missing_fields',
                    'duplicates' => $importer->duplicateEmails,
                    'imported'   => $importer->importedEmails,
                ], now()->addMinutes(10));
                return;
            }

            // 5) Cek invalidEmail
            if ($importer->invalidEmail) {
                \Log::error("ImportAdmin: Ditemukan email tidak valid (bukan @gmail.com)");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'invalid_email',
                    'duplicates' => $importer->duplicateEmails,
                    'imported'   => $importer->importedEmails,
                ], now()->addMinutes(10));
                return;
            }

            // 6) Cek noData
            if ($importer->noData) {
                \Log::info("ImportAdmin: Header valid tapi tidak ada baris data");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'no_data',
                    'duplicates' => $importer->duplicateEmails,
                    'imported'   => $importer->importedEmails,
                ], now()->addMinutes(10));
                return;
            }

            // 7) Cek createdCount
            if ($importer->createdCount === 0) {
                // Artinya semua row Excel sudah ada di DB → hanya duplicate, tidak ada yang di-create
                \Log::info("ImportAdmin: Semua data sudah ada → no_new_data_admin");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'no_new_data_admin',
                    'duplicates' => $importer->duplicateEmails,
                    'imported'   => $importer->importedEmails, // pasti kosong, tapi keep konsisten
                ], now()->addMinutes(10));
            } else {
                // Ada minimal satu row yang berhasil dibuat → kita set status 'done'
                \Log::info("ImportAdmin: Ada {$importer->createdCount} admin baru → done");
                Cache::put("import-status:{$this->jobId}", [
                    'status'     => 'done',
                    'duplicates' => $importer->duplicateEmails,
                    'imported'   => $importer->importedEmails,
                ], now()->addMinutes(10));
            }

        } catch (\Throwable $e) {
            \Log::error("ImportAdmin error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            Cache::put("import-status:{$this->jobId}", [
                'status'     => 'import_failed',
                'duplicates' => [],
                'imported'   => [],
            ], now()->addMinutes(10));
        } finally {
            $lock->release();
            Storage::delete($this->path);
            \Log::info("ImportAdmin: Cleanup—unlock dan delete file " . $this->path);
        }
    }
}
