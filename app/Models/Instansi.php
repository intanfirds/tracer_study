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
        'jenis',
        'jabatan',
        'skala',
        'email_atasan',
        'no_hp_atasan',
    ];

    public $timestamps = true;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'alumni_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }
}
