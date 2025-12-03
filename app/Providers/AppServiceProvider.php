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

    // public function boot()
    // {
    //     View::composer('*', function ($view) {
    //         $totalNotifikasi = 0;

    //         if (auth()->check()) {
    //             $user = auth()->user();

    //             $baseQuery = function ($status, $fakultasField) {
    //                 return Pengajuan::where('status', $status)
    //                     ->whereHas('user', function ($q) use ($fakultasField) {
    //                         $q->where($fakultasField, true);
    //                     })->count();
    //             };

    //             if ($user->is_feb) {
    //                 $pending = $baseQuery('pending', 'is_feb');
    //                 $ditolak = $baseQuery('ditolak', 'is_feb');
    //                 $diterima = $baseQuery('diterima', 'is_feb');
    //                 $totalNotifikasi = $pending + $ditolak + $diterima;
    //             } elseif ($user->is_fikes) {
    //                 $pending = $baseQuery('pending', 'is_fikes');
    //                 $ditolak = $baseQuery('ditolak', 'is_fikes');
    //                 $diterima = $baseQuery('diterima', 'is_fikes');
    //                 $totalNotifikasi = $pending + $ditolak + $diterima;
    //             } elseif ($user->is_fst) {
    //                 $pending = $baseQuery('pending', 'is_fst');
    //                 $ditolak = $baseQuery('ditolak', 'is_fst');
    //                 $diterima = $baseQuery('diterima', 'is_fst');
    //                 $totalNotifikasi = $pending + $ditolak + $diterima;
    //             } elseif ($user->is_rektorat) {
    //                 $pending = $baseQuery('pending', 'is_rektorat');
    //                 $ditolak = $baseQuery('ditolak', 'is_rektorat');
    //                 $diterima = $baseQuery('diterima', 'is_rektorat');
    //                 $totalNotifikasi = $pending + $ditolak + $diterima;
    //             }
    //         }
    //         $view->with('notifikasiPengajuan', $totalNotifikasi);
    //         // $view->with('notifikasiPengajuan', session('notifikasi_pengajuan_admin', 0));
    //     });
    // }

//  public function boot()
// {
//     View::composer('*', function ($view) {
//         $notifikasiPengajuan = [];

//         if (auth()->check()) {
//             $user = auth()->user();

//             // Query untuk menghitung jumlah pengajuan berdasarkan status
//             $baseQuery = function ($status, $fakultasField) {
//                 return Pengajuan::where('status', $status)
//                     ->whereHas('user', function ($q) use ($fakultasField) {
//                         $q->where($fakultasField, true);
//                     })
//                     ->count();  // Menghitung jumlah pengajuan berdasarkan status
//             };

//             if ($user->is_feb) {
//                 $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_feb');
//                 $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_feb');
//                 $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_feb');
//             } elseif ($user->is_fikes) {
//                 $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_fikes');
//                 $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_fikes');
//                 $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_fikes');
//             } elseif ($user->is_fst) {
//                 $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_fst');
//                 $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_fst');
//                 $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_fst');
//             } elseif ($user->is_rektorat) {
//                 $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_rektorat');
//                 $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_rektorat');
//                 $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_rektorat');
//             }
//         }

//         // Kirim data ke view
//         $view->with('notifikasiPengajuan', $notifikasiPengajuan);
//     });
// }


public function boot()
{
    View::composer('*', function ($view) {
        $notifikasiPengajuan = [];
        $hasNotifications = false; // Flag untuk mengecek apakah ada notifikasi

        if (auth()->check()) {
            $user = auth()->user();

            // Query untuk menghitung jumlah pengajuan berdasarkan status
            $baseQuery = function ($status, $fakultasField) {
                return Pengajuan::where('status', $status)
                    ->whereHas('user', function ($q) use ($fakultasField) {
                        $q->where($fakultasField, true);
                    })
                    ->count();  // Menghitung jumlah pengajuan berdasarkan status
            };

            if ($user->is_admin) {
                // Jika admin, tampilkan jumlah pengajuan dari semua fakultas
                $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_admin');
                $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_admin');
                $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_admin');
            } else {
                // Untuk pengguna biasa
                if ($user->is_feb) {
                    $notifikasiPengajuan['pending'] = $baseQuery('pending', 'is_feb');
                    $notifikasiPengajuan['ditolak'] = $baseQuery('ditolak', 'is_feb');
                    $notifikasiPengajuan['diterima'] = $baseQuery('diterima', 'is_feb');
                }
                // Lakukan logika untuk fakultas lainnya
            }

            // Cek apakah ada notifikasi
            // $hasNotifications = $notifikasiPengajuan['pending'] > 0 || $notifikasiPengajuan['ditolak'] > 0 || $notifikasiPengajuan['diterima'] > 0;
        }

        // Kirim data ke view
        $view->with('notifikasiPengajuan', $notifikasiPengajuan);
        $view->with('hasNotifications', $hasNotifications); // Kirim status notifikasi
    });
}








}
