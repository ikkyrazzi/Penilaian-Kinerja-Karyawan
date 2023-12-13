<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $guarded = [];

    public static $rules = [
        'nama_kriteria' => 'required',
        'keterangan'    => 'nullable',
        'bobot      '   => 'nullable',
    ];

    public static $ruleMessages = [
        
    ];

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'id_kriteria', 'id');
    }
}
