<?php

namespace App\Http\Controllers;

use App\DataTables\PublikasiDataTable;
use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PublikasiDataTable $dataTable)
    {
        return $dataTable->render('pages.publikasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.publikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['nama_kegiatan'] = $request->nama_kegiatan;
        $data['tgl_awal'] = $request->tgl_awal;
        $data['tgl_akhir'] = $request->tgl_akhir;
        $data['upload_laporan'] = $request->upload_laporan;
        $data['link_dokumentasi'] = $request->link_dokumentasi;
        $data['link_publikasi'] = $request->link_publikasi;
        $data['user_id'] = auth()->user()->id;

        Publikasi::create($data);
        return redirect()->route('publikasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publikasi $publikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publikasi $publikasi)
    {
        return view('pages.publikasi.edit', compact('publikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publikasi $publikasi)
    {
        $data['nama_kegiatan'] = $request->nama_kegiatan;
        $data['tgl_awal'] = $request->tgl_awal;
        $data['tgl_akhir'] = $request->tgl_akhir;
        $data['upload_laporan'] = $request->upload_laporan;
        $data['link_dokumentasi'] = $request->link_dokumentasi;
        $data['link_publikasi'] = $request->link_publikasi;

        $publikasi->update($data);
        return redirect()->route('publikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publikasi $publikasi)
    {
        $publikasi->delete();
        return redirect()->route('publikasi.index');
    }
}
