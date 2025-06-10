<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo as RelationsBelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable
{
    use HasFactory;

    protected $table = 'alumnis';
    protected $primaryKey = 'alumni_id';

    protected $fillable = [
        'level_id',
        'NIM',
        'password',
        'prodi_id',
        'nama',
        'no_hp',
        'tahun_lulus',
        'email',
    ];

    public $timestamps = true;

    // Relasi ke Level
    public function level(): RelationsBelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }

    // Relasi ke Program Studi
    public function prodi(): RelationsBelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id', 'prodi_id');
    }

    // Relasi ke Profesi (diubah menjadi lebih jelas)
    public function detailProfesi()
    {
        return $this->hasMany(DetailProfesiAlumni::class, 'alumni_id');
    }

    // Relasi ke Instansi (diperbaiki)
    public function instansi()
    {
        return $this->hasOne(Instansi::class, 'alumni_id')->with('jenisInstansi');
    }

    // Relasi ke Survey
    public function survey()
    {
        return $this->hasOne(SurveyKepuasanLulusan::class, 'alumni_id');
    }

    // Relasi ke Token
    public function tokenAlumni()
    {
        return $this->hasOne(TokenAlumni::class, 'alumni_id');
    }

    // Helper Methods
    public function getRoleName(): string
    {
        return $this->level->nama ?? 'Tidak ada level';
    }

    public function getProdiName(): string
    {
        return $this->prodi->nama_prodi ?? 'Tidak ada prodi';
    }

    public function getProfesiName(): string
    {
        return $this->detailProfesi->first()->profesi ?? 'Tidak ada profesi';
    }
}