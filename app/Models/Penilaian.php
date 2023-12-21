<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $fillable = [
        'id_kriteria', 'nama_kriteria', 'waktu_penilaian', 'nip', 'nama_pegawai', 'nama_penilai', 'skor', 'bobot', 'skor_nilai'
    ];

    public static $rules = [
        'id_kriteria'       => 'nullable',
        'nama_kriteria'     => 'nullable',
        'waktu_penilaian'   => 'required',
        'nip'               => 'required',
        'nama_pegawai'      => 'required',
        'nama_penilai'      => 'required',
        'skor'              => 'nullable|in:Sangat Bagus,Bagus,Cukup,Kurang Bagus,Tidak Bagus',
        'bobot'             => 'nullable',
        'skor_nilai'        => 'nullable',
        'hasil'             => 'nullable',
    ];

    public static $ruleMessages = [
        'id_kriteria'       => 'kriteriaId',
        'nip'               => 'nip',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
