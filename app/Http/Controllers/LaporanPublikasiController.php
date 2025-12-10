<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanPublikasiDataTable;
use App\Models\LaporanPublikasi;
use App\Models\Pengajuan;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class LaporanPublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LaporanPublikasiDataTable $dataTable)
    {
        // $tahunAkademik = TahunAkademik::all();
        // return $dataTable->render('pages.laporanPublikasi.index', compact('tahunAkademik'));
        $tahunAkademik = TahunAkademik::orderByDesc('id')->get();
        $selectedPeriode = request('tahun_akademik'); // Jangan auto default

        return $dataTable
            ->with(['tahun_akademik' => $selectedPeriode])
            ->render('pages.laporanPublikasi.index', compact('tahunAkademik', 'selectedPeriode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(LaporanPublikasiDataTable $dataTable)
    // {
    //     $tahunAkademik = TahunAkademik::all();
    //     $tahun_akademik = request('tahun_akademik');
    //     return $dataTable->with('tahun_akademik', $tahun_akademik)
    //         ->render('pages.laporanPublikasi.show', compact('tahunAkademik'));
    // }

    // public function show(Request $request)
    // {
    //     $tahunAkademik = TahunAkademik::all();
    //     $selectedPeriode = $request->get('tahun_akademik'); // Ambil tahun akademik yang dipilih

    //     // Mengambil data berdasarkan tahun yang dipilih
    //     $laporanPublikasi = LaporanPublikasi::with([
    //         'publikasi.tahunAkademik',
    //         'publikasi.pengajuan'
    //     ])
    //     ->whereHas('publikasi.tahunAkademik', function($query) use ($selectedPeriode) {
    //         $query->where('tahun_akademik', $selectedPeriode);
    //     })
    //     ->get();

    //     return view('pages.laporanPublikasi.show', compact('laporanPublikasi', 'tahunAkademik', 'selectedPeriode'));
    // }

    //     public function show(Request $request)
    // {
    //     $tahunAkademik = TahunAkademik::all();
    //     $selectedPeriode = $request->get('tahun_akademik'); // Ambil tahun akademik yang dipilih
    //     $tglAwal = $request->get('tgl_awal'); // Ambil tanggal awal
    //     $tglSelesai = $request->get('tgl_selesai'); // Ambil tanggal selesai (tgl_selesai)

    //     // Query dasar untuk mengambil data
    //     $laporanPublikasi = LaporanPublikasi::with([
    //         'publikasi.tahunAkademik',  // Pastikan relasi ini ada
    //         'publikasi.pengajuan'
    //     ]);

    //     // Filter berdasarkan tahun akademik jika ada
    //     if ($selectedPeriode) {
    //         $laporanPublikasi = $laporanPublikasi->whereHas('publikasi', function($query) use ($selectedPeriode) {
    //             $query->where('tahun_akademik', $selectedPeriode);
    //         });
    //     }

    //     // Filter berdasarkan tgl_awal jika ada
    //     if ($tglAwal && !$tglSelesai) {
    //         // Jika hanya tgl_awal yang diisi, ambil data setelah atau pada tgl_awal
    //         $laporanPublikasi = $laporanPublikasi->whereDate('tgl_awal', '>=', $tglAwal);
    //     }

    //     // Jika tgl_awal dan tgl_selesai keduanya ada, filter berdasarkan rentang tanggal
    //     if ($tglAwal && $tglSelesai) {
    //         $laporanPublikasi = $laporanPublikasi->whereDate('tgl_awal', '>=', $tglAwal)
    //                                              ->whereDate('tgl_awal', '<=', $tglSelesai);
    //     }

    //     // Ambil data laporan publikasi sesuai dengan filter
    //     $laporanPublikasi = $laporanPublikasi->get();

    //     return view('pages.laporanPublikasi.show', compact('laporanPublikasi', 'tahunAkademik', 'selectedPeriode'));
    // }

    public function show(Request $request)
    {
        $tahunAkademik = TahunAkademik::all();
        $selectedPeriode = $request->get('tahun_akademik'); // Ambil tahun akademik yang dipilih
        $tglAwal = $request->get('tgl_awal'); // Ambil tanggal awal
        $tglSelesai = $request->get('tgl_selesai'); // Ambil tanggal selesai

        // Query dasar untuk mengambil data
        $laporanPublikasi = LaporanPublikasi::with([
            'publikasi.tahunAkademik',  // Pastikan relasi ini ada
            'publikasi.pengajuan',
        ]);

        // Filter berdasarkan tahun akademik jika ada
        if ($selectedPeriode) {
            $laporanPublikasi = $laporanPublikasi->whereHas('publikasi', function ($query) use ($selectedPeriode) {
                $query->where('tahun_akademik', $selectedPeriode);
            });
        }

        if ($tglAwal && ! $tglSelesai) {
            // Jika hanya tgl_awal yang diisi, filter berdasarkan tgl_awal
            $laporanPublikasi = $laporanPublikasi->whereDate('tgl_awal', '=', $tglAwal);
        } elseif (! $tglAwal && $tglSelesai) {
            // Jika hanya tgl_selesai yang diisi, filter berdasarkan tgl_selesai
            $laporanPublikasi = $laporanPublikasi->whereDate('tgl_selesai', '=', $tglSelesai);
        }

        // Jika kedua tgl_awal dan tgl_selesai diisi, filter berdasarkan rentang tanggal
        if ($tglAwal && $tglSelesai) {
            $laporanPublikasi = $laporanPublikasi->whereDate('tgl_awal', '>=', $tglAwal)
                ->whereDate('tgl_selesai', '<=', $tglSelesai);
        }

        // Ambil data laporan publikasi sesuai dengan filter
        $laporanPublikasi = $laporanPublikasi->get();

        return view('pages.laporanPublikasi.show', compact('laporanPublikasi', 'tahunAkademik', 'selectedPeriode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPublikasi $laporanPublikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPublikasi $laporanPublikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPublikasi $laporanPublikasi)
    {
        //
    }
}
