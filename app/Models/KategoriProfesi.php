<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProfesi extends Model
{
    use HasFactory;

    protected $table = 'kategori_profesis';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'kode_kategori',
        'nama',
        'keterangan',
    ];

    public $timestamps = true;
}
