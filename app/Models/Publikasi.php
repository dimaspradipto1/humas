<?php
// app/Models/Publikasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;

    // Isi hanya kolom yang benar-benar ada di tabel publikasis
    protected $fillable = [
        'user_id',
        'tahun_akademik_id', // boleh nullable di migrasi
        'pengajuan_id',
        'upload_laporan',
        'link_dokumentasi',
        'link_publikasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    // ACCESSOR opsional — memudahkan DataTables menampilkan nama_kegiatan
    protected $appends = ['nama_kegiatan_pengajuan'];

    public function getNamaKegiatanPengajuanAttribute()
    {
        return optional($this->pengajuan)->nama_kegiatan;
    }
}
