<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenAlumni extends Model
{
    use HasFactory;

    protected $table = 'token_alumni';
    protected $primaryKey = 'token_alumni_id';

    protected $guarded = [];
}