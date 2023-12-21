<?php

namespace App\Imports;

use App\Models\Jabatan;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class JabatanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan kolom-kolom sesuai dengan struktur tabel Jabatan

        // Cek apakah Jabatan dengan nama tersebut sudah ada
        $existingJabatan = Jabatan::where('nama_jabatan', $row['nama_jabatan'])->first();

        // Jika sudah ada, lewati proses penyisipan
        if ($existingJabatan) {
            return null;
        }

        // Jika belum ada, tambahkan Jabatan baru dengan ID UUID
        return Jabatan::create([
            'id' => Uuid::uuid4()->toString(),
            'nama_jabatan' => $row['nama_jabatan'],
            'divisi' => $row['divisi'],
            'deskripsi' => $row['jobdesk'],
        ]);
    }
}
