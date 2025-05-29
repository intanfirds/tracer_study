<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenInstansi extends Model
{
    use HasFactory;

    protected $table = 'token_instansi';
    protected $primaryKey = 'token_instansi_id';

    protected $fillable = [
        'token',
        'instansi_id',
        'expired_at',
        'is_used',
    ];
}