<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $primaryKey = 'level_id';

    protected $fillable = [
        'kode_level',
        'nama',
    ];

    public $timestamps = true;
}
