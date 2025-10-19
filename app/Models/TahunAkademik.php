<?php

namespace App\Models;

use App\Models\Publikasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAkademik extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function laporanPublikasis()
    {
        return $this->hasMany(LaporanPublikasi::class);
    }
    
}
