<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanPublikasiDataTable;
use App\Models\LaporanPublikasi;
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

    public function show(Request $request)
    {
        $tahunAkademik = TahunAkademik::all();
        $selectedPeriode = $request->get('tahun_akademik'); // Ambil tahun akademik yang dipilih

        // Mengambil data berdasarkan tahun yang dipilih
        $laporanPublikasi = LaporanPublikasi::with([
            'publikasi.tahunAkademik',
            'publikasi.pengajuan'
        ])
        ->whereHas('publikasi.tahunAkademik', function($query) use ($selectedPeriode) {
            $query->where('tahun_akademik', $selectedPeriode);
        })
        ->get();

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
