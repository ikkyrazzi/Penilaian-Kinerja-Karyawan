<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class PegawaiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Mengambil ID Jabatan berdasarkan nama_jabatan
        $jabatan = Jabatan::where('nama_jabatan', $row['jabatan'])->first();

        // Mengonversi pilihan pendidikan_terakhir ke dalam format yang sesuai dengan database
        $pendidikanTerakhir = $this->mapPendidikanTerakhir($row['pendidikan']);

        // Check if the record already exists
        $existingRecord = Pegawai::where('nip', $row['no_induk_pegawai'])->first();

        // If the record already exists, skip the import
        if ($existingRecord) {
            return null;
        }

        return new Pegawai([
            'id' => Uuid::uuid4()->toString(),
            'nip' => $row['no_induk_pegawai'],
            'nama_pegawai' => $row['nama_pegawai'],
            'nama_jabatan' => $row['jabatan'],
            'tgl_lahir' => $row['tanggal_lahir'],
            'email' => $row['email'],
            'pendidikan_terakhir' => $pendidikanTerakhir,
            'tgl_masuk' => $row['tanggal_masuk'],
        ]);
    }

    /**
     * Mengonversi pilihan pendidikan_terakhir ke dalam format yang sesuai dengan database.
     *
     * @param string $pendidikanTerakhir
     * @return string|null
     */
    private function mapPendidikanTerakhir($pendidikanTerakhir)
    {
        $mapping = [
            'sma' => 'SMA Sederajat',
            'diploma' => 'Diploma 3',
            'sarjana' => 'Sarjana',
        ];

        return $mapping[$pendidikanTerakhir] ?? null;
    }
}
