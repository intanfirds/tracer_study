<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProgramStudi extends Authenticatable
{
    use HasFactory;

    protected $table = 'program_studis';
    protected $primaryKey = 'prodi_id';

    protected $fillable = [
        'nama_prodi',
    ];

    public $timestamps = true;
}