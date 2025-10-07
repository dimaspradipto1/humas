<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\DataTables\PengajuanDataTable;
use RealRashid\SweetAlert\Facades\Alert;

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
    // public function store(Request $request)
    // {
    //     $data['nama_kegiatan'] = $request->nama_kegiatan;
    //     $data['tgl_awal'] = $request->tgl_awal;
    //     $data['tgl_selesai'] = $request->tgl_selesai;
    //     $data['deskripsi_kegiatan'] = $request->deskripsi_kegiatan;
    //     $data['perlengkapan'] = $request->perlengkapan;
    //     $data['link_zoom'] = $request->link_zoom ?? '-';
    //     $data['jam_kegiatan'] = $request->jam_kegiatan;
    //     $data['waktu_selesai'] = $request->waktu_selesai;
    //     $data['unit_kegiatan'] = $request->unit_kegiatan;
    //     $data['tempat_kegiatan'] = $request->tempat_kegiatan;
    //     $data['user_id'] = auth()->user()->id;
       
        
    
    //     Pengajuan::create($data);
    //     Alert::success('Success', 'Data berhasil ditambahkan')->toToast()->autoclose(3000);
    //     return redirect()->route('pengajuan.index');
    // }

   public function store(Request $request)
    {   
        // Data untuk tabel pengajuan
        $pengajuanData['nama_kegiatan'] = $request->nama_kegiatan;
        $pengajuanData['tgl_awal'] = $request->tgl_awal;
        $pengajuanData['tgl_selesai'] = $request->tgl_selesai;
        $pengajuanData['deskripsi_kegiatan'] = $request->deskripsi_kegiatan;
        $pengajuanData['perlengkapan'] = $request->perlengkapan;
        $pengajuanData['link_zoom'] = $request->link_zoom ?? '-';
        $pengajuanData['jam_kegiatan'] = $request->jam_kegiatan;
        $pengajuanData['waktu_selesai'] = $request->waktu_selesai;
        $pengajuanData['unit_kegiatan'] = $request->unit_kegiatan;
        $pengajuanData['tempat_kegiatan'] = $request->tempat_kegiatan;
        $pengajuanData['user_id'] = auth()->user()->id;  // Mendapatkan ID user yang login

        $pengajuan = Pengajuan::create($pengajuanData);

        // Create empty Publikasi record linked to the newly created Pengajuan
        $publikasi = new Publikasi();
        $publikasi->user_id = auth()->user()->id;
        $publikasi->pengajuan_id = $pengajuan->id;
        $publikasi->tahun_akademik_id = null;
        $publikasi->upload_laporan = null;
        $publikasi->link_dokumentasi = null;
        $publikasi->link_publikasi = null;
        $publikasi->save();

        Alert::success('Success', 'Data berhasil ditambahkan')->toToast()->autoclose(3000);

        // Redirect ke halaman pengajuan
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
        Alert::success('SUCCESS', 'data updated successfully')->autoclose(2000)->toToast();
        return redirect()->route('pengajuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->delete();
        Alert::success('SUSSCESS', 'data deleted successfully')->autoclose(2000)->toToast();
        return redirect()->route('pengajuan.index');
    }
}
