<?php

namespace App\Imports;

use App\Models\Kriteria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KriteriaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan kolom-kolom sesuai dengan struktur tabel Kriteria
        return new Kriteria([
            'id' => $row['id'],
            'nama_kriteria' => $row['nama_kriteria'],
            'keterangan' => $row['keterangan'],
            'bobot' => $row['bobot'],
        ]);
    }
}
