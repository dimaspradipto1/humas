<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Publikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    
        $pengajuan_rektorat = Pengajuan::whereHas('user', function($query) {
            $query->where('is_rektorat', 1);
        })->count();
        
        $pengajuan_feb = Pengajuan::whereHas('user', function($query) {
            $query->where('is_feb', 1);
        })->count();
        
        $pengajuan_fst = Pengajuan::whereHas('user', function($query) {
            $query->where('is_fst', 1);
        })->count();
        
        $pengajuan_fikes = Pengajuan::whereHas('user', function($query) {
            $query->where('is_fikes', 1);
        })->count();

        $publikasi_rektorat = Publikasi::whereHas('user', function($query) {
            $query->where('is_rektorat', 1);
        })->count();
        
        $publikasi_feb = Publikasi::whereHas('user', function($query) {
            $query->where('is_feb', 1);
        })->count();
        
        $publikasi_fst = Publikasi::whereHas('user', function($query) {
            $query->where('is_fst', 1);
        })->count();
        
        $publikasi_fikes = Publikasi::whereHas('user', function($query) {
            $query->where('is_fikes', 1);
        })->count();

        return view('layouts.dashboard.index', [
            'pengajuan_rektorat' => $pengajuan_rektorat,
            'pengajuan_feb' => $pengajuan_feb,
            'pengajuan_fst' => $pengajuan_fst,
            'pengajuan_fikes' => $pengajuan_fikes,
            'publikasi_rektorat' => $publikasi_rektorat,
            'publikasi_feb' => $publikasi_feb,
            'publikasi_fst' => $publikasi_fst,
            'publikasi_fikes' => $publikasi_fikes,
        ]);
    }

}
