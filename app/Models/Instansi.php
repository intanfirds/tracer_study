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
        'jenis_instansi_id',
        'lokasi_instansi',
        'jabatan',
        'skala',
        'email_atasan',
        'no_hp_atasan',
        'kategori_id',
    ];

    public $timestamps = true;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }

    public function surveyKepuasanLulusan()
    {
        return $this->hasMany(SurveyKepuasanLulusan::class, 'instansi_id', 'instansi_id');
    }

    public function jenisInstansi()
    {
        return $this->belongsTo(JenisInstansi::class, 'jenis_instansi_id');
    }

    public function kategoriProfesi()
    {
        return $this->belongsTo(KategoriProfesi::class, 'kategori_id', 'kategori_id');
    }

    public function tokenInstansi()
    {
        return $this->hasOne(TokenInstansi::class, 'instansi_id');
    }
}
