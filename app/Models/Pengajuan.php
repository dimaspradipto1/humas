<?php
// app/Models/Pengajuan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tgl_awal',
        'tgl_selesai',
        'deskripsi_kegiatan',
        'perlengkapan',
        'link_zoom',
        'unit_kegiatan',
        'pic',
        'status',
        'jam_kegiatan',
        'waktu_selesai',
        'tempat_kegiatan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // pilih salah satu: hasOne atau hasMany
    public function publikasi()
    {
        return $this->hasOne(Publikasi::class, 'pengajuan_id'); // one-to-one
        // return $this->hasMany(Publikasi::class, 'pengajuan_id'); // jika one-to-many
    }
}
