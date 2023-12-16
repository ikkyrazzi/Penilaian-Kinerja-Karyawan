<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Pegawai extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $guarded = [];

    public static $rules = [
        'nama_pegawai'          => 'required',
        'jabatan'               => 'nullable',
        'tgl_lahir'             => 'nullable',
        'email'                 => 'required|unique:pegawais,email',
        'pendidikan_terakhir'   => 'nullable',
        'tgl_masuk'             => 'nullable',
        'nip'                   => 'required',
    ];

    public static $ruleMessages = [
        'nama_jabatan'               => 'nama_jabatan',
    ];

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'nip', 'nip');
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'nama_jabatan', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = RamseyUuid::uuid4()->toString();
        });
    }
}
