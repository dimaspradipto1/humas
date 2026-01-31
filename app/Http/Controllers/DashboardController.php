<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Publikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $pengajuan_rektorat = Pengajuan::where('status', 'diterima')->whereHas('user', function ($query) {
            $query->where('is_rektorat', 1);
        })->count();

        $pengajuan_feb = Pengajuan::where('status', 'diterima')->whereHas('user', function ($query) {
            $query->where('is_feb', 1);
        })->count();

        $pengajuan_fst = Pengajuan::where('status', 'diterima')->whereHas('user', function ($query) {
            $query->where('is_fst', 1);
        })->count();

        $pengajuan_fikes = Pengajuan::where('status', 'diterima')->whereHas('user', function ($query) {
            $query->where('is_fikes', 1);
        })->count();

        $publikasi_rektorat = Publikasi::whereHas('user', function ($query) {
            $query->where('is_rektorat', 1);
        })->count();

        $publikasi_feb = Publikasi::whereHas('user', function ($query) {
            $query->where('is_feb', 1);
        })->count();

        $publikasi_fst = Publikasi::whereHas('user', function ($query) {
            $query->where('is_fst', 1);
        })->count();

        $publikasi_fikes = Publikasi::whereHas('user', function ($query) {
            $query->where('is_fikes', 1);
        })->count();


        $latest_pengajuan = Pengajuan::with('user')
            ->where('status', 'diterima')
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_kegiatan', 'like', '%' . $request->search . '%');
            })
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        // Hitung data mingguan untuk line chart (7 hari terakhir)
        $days = [];
        $weekly_data = [
            'Rektorat' => [],
            'FEB' => [],
            'FST' => [],
            'FIKES' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->locale('id')->isoFormat('dddd');
            $days[] = $dayName;

            $weekly_data['Rektorat'][] = Pengajuan::where('status', 'diterima')->whereDate('tgl_awal', $date)->whereHas('user', fn($q) => $q->where('is_rektorat', 1))->count();
            $weekly_data['FEB'][] = Pengajuan::where('status', 'diterima')->whereDate('tgl_awal', $date)->whereHas('user', fn($q) => $q->where('is_feb', 1))->count();
            $weekly_data['FST'][] = Pengajuan::where('status', 'diterima')->whereDate('tgl_awal', $date)->whereHas('user', fn($q) => $q->where('is_fst', 1))->count();
            $weekly_data['FIKES'][] = Pengajuan::where('status', 'diterima')->whereDate('tgl_awal', $date)->whereHas('user', fn($q) => $q->where('is_fikes', 1))->count();
        }

        $list_rektorat = Pengajuan::where('status', 'diterima')->whereHas('user', fn($q) => $q->where('is_rektorat', 1))
            ->get()->map(fn($p) => [
                'nama' => $p->nama_kegiatan,
                'tgl' => \Carbon\Carbon::parse($p->tgl_awal)->locale('id')->translatedFormat('d M Y'),
                'tgl_akhir' => \Carbon\Carbon::parse($p->tgl_selesai)->locale('id')->translatedFormat('d M Y'),
                'total' => $pengajuan_rektorat
            ])
            ->toArray();
        $list_feb = Pengajuan::where('status', 'diterima')->whereHas('user', fn($q) => $q->where('is_feb', 1))
            ->get()->map(fn($p) => [
                'nama' => $p->nama_kegiatan,
                'tgl' => \Carbon\Carbon::parse($p->tgl_awal)->locale('id')->translatedFormat('d M Y'),
                'tgl_akhir' => \Carbon\Carbon::parse($p->tgl_selesai)->locale('id')->translatedFormat('d M Y'),
                'total' => $pengajuan_feb
            ])
            ->toArray();
        $list_fst = Pengajuan::where('status', 'diterima')->whereHas('user', fn($q) => $q->where('is_fst', 1))
            ->get()->map(fn($p) => [
                'nama' => $p->nama_kegiatan,
                'tgl' => \Carbon\Carbon::parse($p->tgl_awal)->locale('id')->translatedFormat('d M Y'),
                'tgl_akhir' => \Carbon\Carbon::parse($p->tgl_selesai)->locale('id')->translatedFormat('d M Y'),
                'total' => $pengajuan_fst
            ])
            ->toArray();
        $list_fikes = Pengajuan::where('status', 'diterima')->whereHas('user', fn($q) => $q->where('is_fikes', 1))
            ->get()->map(fn($p) => [
                'nama' => $p->nama_kegiatan,
                'tgl' => \Carbon\Carbon::parse($p->tgl_awal)->locale('id')->translatedFormat('d M Y'),
                'tgl_akhir' => \Carbon\Carbon::parse($p->tgl_selesai)->locale('id')->translatedFormat('d M Y'),
                'total' => $pengajuan_fikes
            ])
            ->toArray();

        return view('layouts.dashboard.index', [
            'pengajuan_rektorat' => $pengajuan_rektorat,
            'pengajuan_feb' => $pengajuan_feb,
            'pengajuan_fst' => $pengajuan_fst,
            'pengajuan_fikes' => $pengajuan_fikes,
            'publikasi_rektorat' => $publikasi_rektorat,
            'publikasi_feb' => $publikasi_feb,
            'publikasi_fst' => $publikasi_fst,
            'publikasi_fikes' => $publikasi_fikes,
            'latest_pengajuan' => $latest_pengajuan,
            'days' => $days,
            'weekly_data' => $weekly_data,
            'list_rektorat' => $list_rektorat,
            'list_feb' => $list_feb,
            'list_fst' => $list_fst,
            'list_fikes' => $list_fikes,
        ]);
    }
}
