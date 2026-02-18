<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
 {
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'isi_laporan',
        'dokumentasi',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(ProgramKegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
