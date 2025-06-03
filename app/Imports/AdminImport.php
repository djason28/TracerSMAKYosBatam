<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow,
    WithChunkReading
};

class AdminImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /** Jumlah record baru yang berhasil dibuat */
    public int  $createdCount  = 0;

    /** True jika header valid tetapi tidak ada baris data */
    public bool $noData        = false;

    /** True jika ada email yang bukan berakhiran @gmail.com */
    public bool $invalidEmail  = false;

    /** True jika **di salah satu baris** 'email' atau 'nama' kosong */
    public bool $rowMissingField = false;

    /** Daftar email yang sudah ada di DB (duplicate) */
    public array $duplicateEmails = [];

    /** Daftar email yang berhasil di-import */
    public array $importedEmails = [];

    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows)
    {
        // 1) Cek per‐baris: apakah 'email' & 'nama' BETULAN terisi?
        foreach ($rows as $row) {
            $emailRaw = trim($row['email'] ?? '');
            $nameRaw  = trim($row['nama']  ?? '');

            // Jika keduanya kosong: <baris kosong> → skip
            if ($emailRaw === '' && $nameRaw === '') {
                continue;
            }

            // Jika salah satu kosong, → rowMissingField
            if ($emailRaw === '' || $nameRaw === '') {
                $this->rowMissingField = true;
                return; // langsung hentikan, kita laporkan missing_fields
            }
        }

        // 2) Filter baris yang “berisi data” (email or nama tidak kosong)
        $filtered = $rows->filter(function ($row) {
            $emailRaw = trim($row['email'] ?? '');
            $nameRaw  = trim($row['nama']  ?? '');
            return ($emailRaw !== '' || $nameRaw !== '');
        });

        // 3) Jika setelah filter kosong → noData
        if ($filtered->isEmpty()) {
            $this->noData = true;
            return;
        }

        // 4) Cek format email (harus @gmail.com) pada setiap baris yang ada email‐nya
        foreach ($filtered as $row) {
            $emailRaw = trim($row['email'] ?? '');
            if ($emailRaw === '') {
                // baris hanya punya nama (tapi karena rowMissingField=false 
                // di awal, kita tahu setiap baris yang ada nama pasti punya email),
                // disini bisa skip
                continue;
            }
            if (! str_ends_with(strtolower($emailRaw), '@gmail.com')) {
                $this->invalidEmail = true;
                return;
            }
        }

        // 5) Jika semua email valid, insert data tapi catat duplicate & imported
        DB::transaction(function () use ($filtered) {
            foreach ($filtered as $row) {
                $emailRaw = trim($row['email'] ?? '');
                if ($emailRaw === '') continue;
                if (! str_ends_with(strtolower($emailRaw), '@gmail.com')) {
                    $this->invalidEmail = true; // safety check
                    return;
                }
                $name = trim($row['nama'] ?? '');
                $existingUser = User::where('email', $emailRaw)->first();
                if ($existingUser) {
                    // Tandai sebagai duplicate
                    $this->duplicateEmails[] = $emailRaw;
                    continue;
                }
                // Kalau belum ada → buat user baru, catat sebagai imported
                User::create([
                    'email'    => $emailRaw,
                    'name'     => $name,
                    'password' => bcrypt('admin123'),
                    'role'     => 'admin',
                ]);
                $this->createdCount++;
                $this->importedEmails[] = $emailRaw;
            }
        });
    }
}
