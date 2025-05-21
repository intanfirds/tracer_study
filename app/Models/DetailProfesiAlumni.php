<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProfesiAlumni extends Model
{
    use HasFactory;

    protected $table = 'detail_profesi_alumnis';
    protected $primaryKey = 'detail_profesi_id';

    // protected $fillable = [
    //     'alumni_id',
    //     'kategori_id',
    //     'tahun_lulus',
    //     'tanggal_pertama_kerja',
    //     'masa_tunggu',
    //     'tanggal_mulai_kerja_instansi_saat_ini',
    //     'tanggal_pengisian',
    //     'status_pengisian',
    // ];
    protected $guarded=[];

    public $timestamps = true;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'alumni_id');
    }
}
