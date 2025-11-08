<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\LaporanPublikasi;
use App\Models\KotakMasukPengajuan;
use App\DataTables\PengajuanDataTable;
use App\Http\Requests\PengajuanRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(PengajuanDataTable $dataTable)
    // {
    //     // Hitung jumlah pengajuan dengan status 'pending'
    //     $pendingPengajuan = Pengajuan::where('status', 'pending')->count();

    //     // Hitung jumlah pengajuan dengan status 'ditolak'
    //     $ditolakPengajuan = Pengajuan::where('status', 'ditolak')->count();

    //     return $dataTable->render('pages.pengajuan.index', compact('pendingPengajuan', 'ditolakPengajuan'));
    // }

    public function index(PengajuanDataTable $dataTable)
    {
        $user = auth()->user();
        
        // Inisialisasi semua variabel dengan 0
        $pendingPengajuanFEB = 0;
        $pendingPengajuanFIKES = 0;
        $pendingPengajuanFST = 0;
        $ditolakPengajuanFEB = 0;
        $ditolakPengajuanFIKES = 0;
        $ditolakPengajuanFST = 0;   
        $pendingPengajuanRektorat = 0;
        $ditolakPengajuanRektorat = 0;
        
        // Cek fakultas user dan hitung pengajuan
        if ($user->is_feb) {
            $pendingPengajuanFEB = Pengajuan::where('status', 'pending')
                ->whereHas('user', function ($query) {
                    $query->where('is_feb', true);
                })->count();
                
            $ditolakPengajuanFEB = Pengajuan::where('status', 'ditolak')
                ->whereHas('user', function ($query) {
                    $query->where('is_feb', true);
                })->count();
                
        } elseif ($user->is_fikes) {
            $pendingPengajuanFIKES = Pengajuan::where('status', 'pending')
                ->whereHas('user', function ($query) {
                    $query->where('is_fikes', true);
                })->count();
                
            $ditolakPengajuanFIKES = Pengajuan::where('status', 'ditolak')
                ->whereHas('user', function ($query) {
                    $query->where('is_fikes', true);
                })->count();
                
        } elseif ($user->is_fst) {
            $pendingPengajuanFST = Pengajuan::where('status', 'pending')
                ->whereHas('user', function ($query) {
                    $query->where('is_fst', true);
                })->count();
                
            $ditolakPengajuanFST = Pengajuan::where('status', 'ditolak')
                ->whereHas('user', function ($query) {
                    $query->where('is_fst', true);
                })->count();
        } elseif ($user->is_rektorat) {
            $pendingPengajuanRektorat = Pengajuan::where('status', 'pending')
                ->whereHas('user', function ($query) {
                    $query->where('is_rektorat', true);
                })->count();
                
            $ditolakPengajuanRektorat = Pengajuan::where('status', 'ditolak')
                ->whereHas('user', function ($query) {
                    $query->where('is_rektorat', true);
                })->count();
        }
        // Kirim data ke view
        return $dataTable->render('pages.pengajuan.index', compact(
            'pendingPengajuanFEB', 
            'ditolakPengajuanFEB',
            'pendingPengajuanFIKES', 
            'ditolakPengajuanFIKES',
            'pendingPengajuanFST', 
            'ditolakPengajuanFST',
            'pendingPengajuanRektorat',
            'ditolakPengajuanRektorat'
        ));
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

        $pengajuan = Pengajuan::create([
            'user_id'           => auth()->id(),
            'tahun_akademik_id' => $data['tahun_akademik_id'],
            'nama_kegiatan'     => $data['nama_kegiatan'],
            'tgl_awal'          => $data['tgl_awal'],
            'tgl_selesai'       => $data['tgl_selesai'],
            'jam_kegiatan'      => $data['jam_kegiatan'],
            'waktu_selesai'     => $data['waktu_selesai'],
            'deskripsi_kegiatan' => $data['deskripsi_kegiatan'] ?? null,
            'perlengkapan'      => $data['perlengkapan'] ?? null,
            'link_zoom'         => $data['link_zoom'] ?? null, // simpan null; tampilkan '-' di view
            'unit_kegiatan'     => $data['unit_kegiatan'],
            'tempat_kegiatan'   => $data['tempat_kegiatan'],
            'alasan_ditolak'    => $data['alasan_ditolak'] ?? null,
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

        // 4) Buat KotakMasukPengajuan terkait pengajuan yang baru
        KotakMasukPengajuan::create([
            'pengajuan_id'  => $pengajuan->id,
        ]);

        Alert::success('Success', 'Data berhasil ditambahkan')->toToast()->autoclose(3000);

        return redirect()->route('pengajuan.index');
    }

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
        $tahunAkademik = TahunAkademik::all();
        return view('pages.pengajuan.edit', compact('pengajuan', 'tahunAkademik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        // Jika status pengajuan adalah 'ditolak', simpan alasan ditolak
        if ($request->status == 'ditolak') {
            $pengajuan->alasan_ditolak = $request->alasan_ditolak;
        } else {
            // Jika status bukan 'ditolak', set alasan ditolak menjadi null
            $pengajuan->alasan_ditolak = null;
        }

        // Cek jika pengguna adalah admin
        if (auth()->user()->is_admin) {
            $data = $request->all();
            $pengajuan->update($data);
            Alert::success('SUCCESS', 'Data berhasil diperbarui')->autoclose(2000)->toToast();
            return redirect()->route('kotak-masuk-pengajuan.index');
        }
        // Cek jika pengguna adalah is_feb, is_fst, atau is_fikes
        elseif (auth()->user()->is_feb || auth()->user()->is_fst || auth()->user()->is_fikes) {
            // Jika status bukan 'ditolak', ubah status menjadi 'pending'
            if ($request->status != 'ditolak') {
                $pengajuan->status = 'pending';
            }

            $data = $request->all();
            $pengajuan->update($data);
            Alert::success('SUCCESS', 'Data berhasil diperbarui')->autoclose(2000)->toToast();

            // Redirect ke halaman pengajuan berdasarkan role
            return redirect()->route('pengajuan.index');
        }

        // Jika tidak ada role yang cocok
        return redirect()->back()->with('error', 'Akses ditolak.');
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
