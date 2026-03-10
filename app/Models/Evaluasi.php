<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $fillable = [
        'kegiatan_id',
        'bidang_id',
        'catatan',
        'status_pencapaian',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(ProgramKegiatan::class, 'kegiatan_id');
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
    
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}
