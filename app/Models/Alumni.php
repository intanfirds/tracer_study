<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable
{
    use HasFactory;

    protected $table = 'alumnis';
    protected $primaryKey = 'alumni_id';

    protected $fillable = [
        'level_id',
        'NIM',
        'password',
        'prodi_id',
        'nama',
        'no_hp',
        'email',
    ];

    public function detailProfesi()
    {
        return $this->hasOne(\App\Models\DetailProfesiAlumni::class, 'alumni_id', 'alumni_id');
    }

    public function prodi()
    {
        return $this->belongsTo(\App\Models\ProgramStudi::class, 'prodi_id', 'prodi_id');
    }

    public $timestamps = true;
}
