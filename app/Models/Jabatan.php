<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Jabatan extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $guarded = [];

    public static $rules = [
        'nama_jabatan'  => 'required',
        'divisi'        => 'required',
    ];

    public static $ruleMessages = [
        
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = RamseyUuid::uuid4()->toString();
        });
    }
}
