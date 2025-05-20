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
        'email',
    ];

    public function detailProfesi()
    {
        return $this->hasOne(DetailProfesiAlumni::class, 'alumni_id', 'alumni_id');
    }

    public $timestamps = true;

    public function level(): RelationsBelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }

    public function getRoleName(): string
    {
        return $this->level->nama;
    }

    public function prodi(): RelationsBelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id', 'prodi_id');
    }

    public function getProdiName(): string
    {
        return $this->prodi->nama_prodi;
    }
    public function instansi()
    {
    return $this->hasOne(Instansi::class, 'alumni_id', 'alumni_id');
    }

}
