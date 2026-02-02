<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

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

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();
    }
}
