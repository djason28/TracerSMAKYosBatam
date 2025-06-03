<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow,
    WithChunkReading
};

class AlumniImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /** Jumlah record baru yang berhasil dibuat */
    public int  $createdCount    = 0;

    /** True jika header valid tapi tidak ada satu pun baris data */
    public bool $noData          = false;

    /** True jika ada NIS yang bukan 4 digit angka */
    public bool $invalidNis      = false;

    /** True jika di satu baris kolom 'nis' atau 'nama' kosong */
    public bool $rowMissingField = false;

    /** Daftar NIS yang sudah ada di DB (duplicate) */
    public array $duplicateNis   = [];

    /** Daftar NIS yang berhasil di‐import */
    public array $importedNis    = [];

    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows)
    {
        // 1) Validasi per‐baris: 'nis' & 'nama' harus terisi → kalau salah satu kosong → rowMissingField
        foreach ($rows as $row) {
            $nisRaw  = trim($row['nis']  ?? '');
            $nameRaw = trim($row['nama'] ?? '');

            // Jika keduanya kosong: baris benar‐benar kosong → nanti di‐filter oleh noData
            if ($nisRaw === '' && $nameRaw === '') {
                continue;
            }

            // Jika salah satu kosong → langsung laporkan missing_fields
            if ($nisRaw === '' || $nameRaw === '') {
                $this->rowMissingField = true;
                return; // hentikan proses selanjutnya
            }
        }

        // 2) Filter baris yang “berisi data” (nis atau nama terisi)
        $filtered = $rows->filter(function($row) {
            $nisValue  = trim($row['nis']  ?? '');
            $nameValue = trim($row['nama'] ?? '');
            return ($nisValue !== '' || $nameValue !== '');
        });

        // 3) Jika setelah filter kosong → noData = true
        if ($filtered->isEmpty()) {
            $this->noData = true;
            return;
        }

        // 4) Validasi format NIS (harus 4 digit angka) pada setiap baris yang punya 'nis'
        foreach ($filtered as $row) {
            $nisRaw = trim($row['nis'] ?? '');
            if ($nisRaw === '') {
                // Kalau NIS kosong, tapi nama terisi (seharusnya sudah di-catch rowMissingField sebelumnya), skip
                continue;
            }
            if (! preg_match('/^[0-9]{4}$/', $nisRaw)) {
                // Format salah → invalidNis = true, hentikan
                $this->invalidNis = true;
                return;
            }
        }

        // 5) Semua valid → insert ke DB sambil catat duplicate & imported
        DB::transaction(function () use ($filtered) {
            foreach ($filtered as $row) {
                $nisRaw = trim($row['nis']  ?? '');
                $name   = trim($row['nama'] ?? '');

                if ($nisRaw === '') {
                    // NIS hanya kosong (harusnya tidak terjadi karena rowMissingField=false), skip
                    continue;
                }

                // Safety‐check format NIS sekali lagi
                if (! preg_match('/^[0-9]{4}$/', $nisRaw)) {
                    $this->invalidNis = true;
                    return;
                }

                $existingUser = User::where('nis', $nisRaw)->first();
                if ($existingUser) {
                    // Tandai sebagai duplicate
                    $this->duplicateNis[] = $nisRaw;
                    continue;
                }

                // Buat record alumni baru
                User::create([
                    'nis'      => $nisRaw,
                    'name'     => $name,
                    'password' => bcrypt('12345678'),
                    'role'     => 'alumni',
                ]);

                $this->createdCount++;
                $this->importedNis[] = $nisRaw;
            }
        });
    }
}
