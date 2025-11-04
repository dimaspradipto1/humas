<?php
// app/Models/Pengajuan.php
namespace App\Models;


use App\Models\Publikasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'tahun_akademik_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tahunAkdemik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function publikasi()
    {
        return $this->hasOne(Publikasi::class, 'pengajuan_id');
    }
 
    public function kotakMasukPengajuan()
    {
        return $this->hasOne(KotakMasukPengajuan::class, 'pengajuan_id');
    }
    
}
