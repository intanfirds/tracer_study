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

    public $timestamps = true;
}
