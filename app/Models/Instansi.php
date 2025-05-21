<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'alumni_id', 'alumni_id');
    }

    public $timestamps = true;

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'alumni_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }
}
