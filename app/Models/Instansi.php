<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansis';
    protected $primaryKey = 'instansi_id';

    protected $fillable = [
        'level_id',
        'alumni_id',
        'nama_instansi',
        'nama_atasan',
        'jenis_instansi_id',
        'lokasi_instansi',
        'jabatan',
        'skala',
        'email_atasan',
        'no_hp_atasan',
    ];

    public $timestamps = true;
}
