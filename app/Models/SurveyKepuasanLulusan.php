<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyKepuasanLulusan extends Model
{
    use HasFactory;

    protected $table = 'survey_kepuasan_lulusans';
    protected $primaryKey = 'survey_id';

    protected $fillable = [
        'alumni_id',
        'instansi_id',
        'tanggal',
        'kerjasama_tim',
        'keahlian_bidang_it',
        'kemampuan_berbahasa_asing',
        'kemampuan_berkomunikasi',
        'pengembangan_diri',
        'kepemimpinan',
        'etos_kerja',
        'saran_untuk_kurikulum_prodi',
        'kemampuan_tdk_terpenuhi',
        'status_pengisian',
    ];

    public $timestamps = true;
}
