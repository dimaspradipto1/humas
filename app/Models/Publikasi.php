<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun_akademik_id',
        'pengajuan_id',
        'upload_laporan',
        'link_dokumentasi',
        'link_publikasi',
    ];

    public function pengajuan()
    {
        // PK pengajuans.id  — FK publikasis.pengajuan_id
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function tahunAkademik()
    {
        // PK tahun_akademiks.id — FK publikasis.tahun_akademik_id
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporanPublikasi()
    {
        return $this->hasOne(LaporanPublikasi::class, 'publikasi_id');
    }
}
