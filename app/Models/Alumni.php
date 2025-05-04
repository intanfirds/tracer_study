<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $primaryKey = 'alumni_id';

    protected $fillable = [
        'level_id',
        'NIM',
        'password',
        'program_studi',
        'nama',
        'no_hp',
        'email',
    ];

    public $timestamps = true;
}
