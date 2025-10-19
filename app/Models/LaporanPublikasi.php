<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publikasi;
class LaporanPublikasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publikasi()
    {
        return $this->belongsTo(Publikasi::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
