<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPengisian extends Model
{
    use HasFactory;

    protected $primaryKey = 'permintaan_id';

    protected $fillable = [
        'admin_id',
        'instansi_id',
        'tanggal_dikirim',
    ];

    public $timestamps = true;
}
