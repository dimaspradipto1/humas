<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\LaporanPublikasi;
use App\DataTables\PengajuanDataTable;
use App\Http\Requests\PengajuanRequest;
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
        $tahunAkademik = TahunAkademik::all();
        return view('pages.pengajuan.create', compact('tahunAkademik'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(PengajuanRequest $request)
    {
        $data = $request->validated();

        // 1) Buat Pengajuan
        $pengajuan = Pengajuan::create([
            'user_id'           => auth()->id(),
            'tahun_akademik_id' => $data['tahun_akademik_id'],
            'nama_kegiatan'     => $data['nama_kegiatan'],
            'tgl_awal'          => $data['tgl_awal'],
            'tgl_selesai'       => $data['tgl_selesai'],
            'jam_kegiatan'      => $data['jam_kegiatan'],
            'waktu_selesai'     => $data['waktu_selesai'],
            'deskripsi_kegiatan'=> $data['deskripsi_kegiatan'] ?? null,
            'perlengkapan'      => $data['perlengkapan'] ?? null,
            'link_zoom'         => $data['link_zoom'] ?? null, // simpan null; tampilkan '-' di view
            'unit_kegiatan'     => $data['unit_kegiatan'],
            'tempat_kegiatan'   => $data['tempat_kegiatan'],
        ]);

        // 2) Buat Publikasi terkait pengajuan yang baru
        $pengajuan->publikasi()->create([
            'user_id'           => auth()->id(),
            'tahun_akademik_id' => $data['tahun_akademik_id'],
            'upload_laporan'    => null,
            'link_dokumentasi'  => null,
            'link_publikasi'    => null,
        ]); 

        // 3) Buat LaporanPublikasi terkait publikasi yang baru
        LaporanPublikasi::create([
            'user_id'       => auth()->id(),
            'publikasi_id'  => $pengajuan->publikasi->id,
            'pengajuan_id'  => $pengajuan->id,
        ]);

        Alert::success('Success', 'Data berhasil ditambahkan')->toToast()->autoclose(3000);

        return redirect()->route('pengajuan.index');
    }


//    public function store(Request $request)
//     {   
//         // Data untuk tabel pengajuan
//         $pengajuanData['nama_kegiatan'] = $request->nama_kegiatan;
//         $pengajuanData['tgl_awal'] = $request->tgl_awal;
//         $pengajuanData['tgl_selesai'] = $request->tgl_selesai;
//         $pengajuanData['deskripsi_kegiatan'] = $request->deskripsi_kegiatan;
//         $pengajuanData['perlengkapan'] = $request->perlengkapan;
//         $pengajuanData['link_zoom'] = $request->link_zoom ?? '-';
//         $pengajuanData['jam_kegiatan'] = $request->jam_kegiatan;
//         $pengajuanData['waktu_selesai'] = $request->waktu_selesai;
//         $pengajuanData['unit_kegiatan'] = $request->unit_kegiatan;
//         $pengajuanData['tempat_kegiatan'] = $request->tempat_kegiatan;
//         $pengajuanData['user_id'] = auth()->user()->id;
//         $pengajuanData['tahun_akademik_id'] = $request->tahun_akadmeik_id;


//         $pengajuan = Pengajuan::create($pengajuanData);

//         // Create empty Publikasi record linked to the newly created Pengajuan
//         $publikasi = new Publikasi();
//         $publikasi->user_id = auth()->user()->id;
//         $publikasi->pengajuan_id = $pengajuan->id;
//         $publikasi->tahun_akademik_id = null;
//         $publikasi->upload_laporan = null;
//         $publikasi->link_dokumentasi = null;
//         $publikasi->link_publikasi = null;
//         $publikasi->save();

//         Alert::success('Success', 'Data berhasil ditambahkan')->toToast()->autoclose(3000);

//         // Redirect ke halaman pengajuan
//         return redirect()->route('pengajuan.index');
//     }



    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        $tahunAkademik = TahunAkademik::all();
        return view('pages.pengajuan.show', compact('pengajuan', 'tahunAkademik'));
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
