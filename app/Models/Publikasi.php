<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kegiatan',
        'tgl_awal',
        'tgl_akhir',
        'upload_laporan',
        'link_dokumentasi',
        'link_publikasi',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
