<?php

namespace App\Http\Controllers;

use App\DataTables\PengajuanDataTable;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PengajuanDataTable $dataTable)
    {
        
        return $dataTable->render('pages.pengajuan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['nama_kegiatan'] = $request->nama_kegiatan;
        $data['tgl_awal'] = $request->tgl_awal;
        $data['tgl_selesai'] = $request->tgl_selesai;
        $data['deskripsi_kegiatan'] = $request->deskripsi_kegiatan;
        $data['link_zoom'] = $request->link_zoom;
        $data['jam_kegiatan'] = $request->jam_kegiatan;
        $data['waktu_selesai'] = $request->waktu_selesai;
        $data['unit_kegiatan'] = $request->unit_kegiatan;
        $data['pic'] = $request->pic;
        $data['tempat_kegiatan'] = $request->tempat_kegiatan;
        $data['user_id'] = auth()->user()->id;

        Pengajuan::create($data);
        return redirect()->route('pengajuan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        return view('pages.pengajuan.show', compact('pengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        return view('pages.pengajuan.edit', compact('pengajuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {

        $data = $request->all();
        $pengajuan->update($data);
        return redirect()->route('pengajuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->delete();
        return redirect()->route('pengajuan.index');
    }
}
