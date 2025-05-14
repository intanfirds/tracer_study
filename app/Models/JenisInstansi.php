<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisInstansi extends Model
{
    use HasFactory;

    protected $table = 'jenis_instansis';
    protected $primaryKey = 'jenis_instansi_id';

    protected $fillable = [
        'nama_jenis_instansi',
    ];

    public $timestamps = true;
}