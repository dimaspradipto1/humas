<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     App::setLocale('id');
    //     Carbon::setLocale('id');
    // }

    public function boot()
    {
        // Share notifikasi pengajuan ke semua view
        View::composer('*', function ($view) {
            $totalNotifikasi = 0;
            
            if (auth()->check()) {
                $user = auth()->user();
                
                // Query builder untuk menghindari duplikasi
                $baseQuery = function($status, $fakultasField) {
                    return Pengajuan::where('status', $status)
                        ->whereHas('user', function ($q) use ($fakultasField) {
                            $q->where($fakultasField, true);
                        })->count();
                };
                
                // Hitung berdasarkan fakultas user
                if ($user->is_feb) {
                    $pending = $baseQuery('pending', 'is_feb');
                    $ditolak = $baseQuery('ditolak', 'is_feb');
                    $totalNotifikasi = $pending;
                    
                } elseif ($user->is_fikes) {
                    $pending = $baseQuery('pending', 'is_fikes');
                    $ditolak = $baseQuery('ditolak', 'is_fikes');
                    $totalNotifikasi = $pending;
                    
                } elseif ($user->is_fst) {
                    $pending = $baseQuery('pending', 'is_fst');
                    $ditolak = $baseQuery('ditolak', 'is_fst');
                    $totalNotifikasi = $pending;
                }elseif ($user->is_rektorat) {
                    $pending = $baseQuery('pending', 'is_rektorat');
                    $ditolak = $baseQuery('ditolak', 'is_rektorat');
                    $totalNotifikasi = $pending;
                }

                // Jika user adalah admin, tampilkan semua notifikasi tanpa harus klik menu
                // if ($user->is_admin) {
                //     // Hitung untuk Kotak Masuk Pengajuan Kegiatan (semua pending dan ditolak)
                //     $totalNotifikasi = Pengajuan::whereIn('status', ['pending', 'ditolak'])->count();
                //     // Simpan total notifikasi admin di session
                //     session(['notifikasi_pengajuan_admin' => $totalNotifikasi]);
                // }

                }
            // Share ke semua view
            $view->with('notifikasiPengajuan', $totalNotifikasi);
            // $view->with('notifikasiPengajuan', session('notifikasi_pengajuan_admin', 0));
        });
    }
}
