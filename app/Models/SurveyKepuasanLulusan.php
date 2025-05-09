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
        'instansi',
        'tanggal',
        'kerja_sama_tim',
        'kemampuan_berbahasa',
        'kemampuan_berkomunikasi',
        'etos_kerja',
        'saran_untuk_kurikulum',
        'kemampuan_tdk_terpenuhi',
        'status_pengisian',
    ];

    public $timestamps = true;
}
