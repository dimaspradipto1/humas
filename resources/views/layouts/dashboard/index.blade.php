@extends('layouts.dashboard.template')

@section('content')
    <!-- sidebar -->
    <div class="py-4">
        <div class="dropdown">
            {{-- <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Task
            </button> --}}
            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                        </path>
                    </svg>
                    Add User
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                        </path>
                    </svg>
                    Add Widget
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                        </path>
                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                    </svg>
                    Upload Files
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Preview Security
                </a>
            </div>
        </div>
        <!-- end sidebar -->

        <!-- content -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <header class="welcome-header">
                            <h1>Selamat datang di Sistem Humas dan Publikasi</h1>
                            <p>Sistem ini dirancang untuk memonitoring aktivitas seluruh bidang humas di masing-masing
                                fakultas.<br>
                                Kami berkomitmen untuk memastikan koordinasi yang efektif dan transparansi dalam setiap
                                kegiatan
                                humas di seluruh unit.
                            </p>
                        </header>
                    </div>
                    <style>
                        .welcome-header {
                            background: linear-gradient(445deg, #4CAF50, #FFEB3B);
                            /* Gradasi warna ungu ke biru */
                            color: white;
                            padding: 30px;
                            border-radius: 15px;
                            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                            /* Memberikan kesan 'elevated' */
                            text-align: center;
                            margin-bottom: 20px;
                            /* Memberikan jarak bawah */
                        }

                        .welcome-header h1 {
                            font-size: 2.5rem;
                            font-weight: 700;
                            margin-bottom: 15px;
                            /* Memberikan ruang di bawah judul */
                        }

                        .welcome-header p {
                            font-size: 1.1rem;
                            line-height: 1.6;
                            font-weight: 400;
                            text-align: center;
                            max-width: 800px;
                            margin: 0 auto;
                        }

                        /* Responsif: Pada layar lebih kecil (mobile) buat teks justify */
                        @media (max-width: 767px) {
                            .welcome-header h1 {
                                font-size: 2rem;
                                font-weight: 600;
                            }

                            .welcome-header p {
                                font-size: 1rem;
                                line-height: 1.4;
                                font-weight: 400;
                                text-align: justify;
                                max-width: 800px;
                                margin: 0 auto;
                            }
                        }

                        /* Menambahkan efek animasi pada header */
                        @keyframes fadeIn {
                            0% {
                                opacity: 0;
                                transform: translateY(30px);
                            }

                            100% {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        /* Menerapkan animasi fadeIn pada header */
                        .welcome-header {
                            animation: fadeIn 1s ease-in-out;
                        }
                    </style>


                </div>
            </div>
            @if(Auth::user()->is_admin == 1)
            {{-- grafik  monitoring pelaporan kegiatan --}}
            <div class="col-12 col-xl-12 mb-4">
                <div class="card bg-yellow-100 border-0 shadow">
                    <div class="card-header d-flex flex-column flex-sm-row align-items-sm-center flex-0">
                        <div class="d-block mb-3 mb-sm-0">
                            <div class="fs-5 fw-normal mb-2 text-capitalize"></div>
                            <h2 class="h6 fw-extrabold text-capitalize mb-0">Monitoring Pelaporan Kegiatan</h2>
                            <div class="small mt-2">
                            </div>
                        </div>
                        <div class="d-flex ms-sm-auto mt-3 mt-sm-0">
                            <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                            <a href="#" class="btn btn-dark btn-sm me-0 me-sm-3">Week</a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="line-chart ct-major-tenth"></div>
                    </div>
                </div>
            </div>
            {{-- end grafik monitoring pelaporan kegiatan --}}
            @endif

            {{-- grafik persentase monitoring pelaporan kegiatan --}}
            {{-- <div class="col-6 col-xl-6">
                <div class="col-12 px-0 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header d-flex flex-row align-items-center flex-0 border-bottom">
                            <div class="d-block">
                                <div class="h6 fw-normal text-gray mb-2 text-capitalize">persentasi</div>
                                <h2 class="h3 fw-extrabold text-capitalize">humas dan publikasi</h2>

                            </div>
                            <div class="d-block ms-auto">
                                <div class="d-flex align-items-center text-end">
                                    <span class="dot rounded-circle"
                                        style="background-color: #007F3B; margin-right: 0.5rem;"></span>
                                    <span class="fw-normal small text-uppercase">rektorat</span>
                                </div>
                                <div class="d-flex align-items-center text-end">
                                    <span class="dot rounded-circle"
                                        style="background-color: #fe9a20; margin-right: 0.5rem;"></span>
                                    <span class="fw-normal small">FEB</span>
                                </div>
                                <div class="d-flex align-items-center text-end mb-2">
                                    <span class="dot rounded-circle"
                                        style="background-color: #810000; margin-right: 0.5rem;"></span>
                                    <span class="fw-normal small">FST</span>
                                </div>

                                <div class="d-flex align-items-center text-end">
                                    <span class="dot rounded-circle"
                                        style="background-color: #B33791; margin-right: 0.5rem;"></span>
                                    <span class="fw-normal small">FIKES</span>
                                </div>
                            </div>

                        </div>
                        <div class="card-body p-2">
                            <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                            <div class="pie-chart ct-golden-section ct-series-a"></div>
                            <div class="pie-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                <div>
                                    <div class="h6 mb-0 d-flex align-items-center">
                                        <svg class="icon icon-xs text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Global Rank
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="d-flex align-items-center fw-bold">
                                        #755
                                        <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                                <div>
                                    <div class="h6 mb-0 d-flex align-items-center">
                                        <svg class="icon icon-xs text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Country Rank
                                    </div>
                                    <div class="small card-stats">
                                        United States
                                        <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="d-flex align-items-center fw-bold">
                                        #32
                                        <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3">
                                <div>
                                    <div class="h6 mb-0 d-flex align-items-center">
                                        <svg class="icon icon-xs text-gray-500 me-2" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                                clip-rule="evenodd"></path>
                                            <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z">
                                            </path>
                                        </svg>
                                        Category Rank
                                    </div>
                                    <div class="small card-stats">
                                        Computers Electronics > Technology
                                        <svg class="icon icon-xs text-success" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="d-flex align-items-center fw-bold">
                                        #11
                                        <svg class="icon icon-xs text-gray-500 ms-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- end grafik persentase monitoring pelaporan kegiatan --}}
        </div>

        <div class="row mt-4">
            <div class="col-12 col-xl-12">
                <div class="card border-0 shadow">
                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                        <h2 class="fs-5 fw-bold mb-0">Events</h2>
                        <form action="{{ url()->current() }}" method="GET" class="d-flex" style="max-width: 300px;">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text border-gray-300" id="basic-addon1">
                                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" name="search" id="eventSearchInput"
                                    class="form-control border-gray-300" placeholder="Cari..."
                                    value="{{ request('search') }}" aria-label="Search">
                            </div>
                        </form>
                    </div>
                    <div class="card-body" id="eventsListContainer">
                        @forelse ($latest_pengajuan as $item)
                            <div class="row align-items-center d-block d-sm-flex border-bottom pb-4 mb-4">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="calendar">
                                        <span
                                            class="calendar-month">{{ \Carbon\Carbon::parse($item->tgl_awal)->locale('id')->translatedFormat('M') }}</span>
                                        <span
                                            class="calendar-day">{{ \Carbon\Carbon::parse($item->tgl_awal)->format('d') }}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="h5 mb-1">{{ $item->nama_kegiatan }}</h3>
                                    <span>Diselenggarakan Oleh <span
                                            class="text-primary">{{ $item->user->name ?? 'N/A' }}</span></span>
                                    <div class="small fw-bold text-gray-700 mt-1">
                                        @if ($item->tgl_awal == $item->tgl_selesai)
                                            Waktu Pelaksanaan: {{ $item->jam_kegiatan }} - {{ $item->waktu_selesai }} WIB
                                        @else
                                            Waktu Pelaksanaan:
                                            {{ \Carbon\Carbon::parse($item->tgl_awal)->locale('id')->translatedFormat('D, d M') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->tgl_selesai)->locale('id')->translatedFormat('D, d M Y') }}
                                        @endif
                                    </div>
                                    <span class="small fw-bold text-gray-700">Tempat Pelaksanaan:
                                        {{ $item->tempat_kegiatan }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted">Tidak ada kegiatan yang akan datang.</p>
                            </div>
                        @endforelse
                    </div>
                    @if(Auth::user()->is_admin == 1)
                    <div class="card-footer border-top py-3" id="eventsPaginationContainer">
                        <div class="d-flex justify-content-center mb-3">
                            {{ $latest_pengajuan->links('pagination::bootstrap-5') }}
                        </div>
                        <div class="text-center">
                            <a href="{{ route('kotak-masuk-pengajuan.index') }}"
                                class="text-gray-800 fw-bold d-inline-flex align-items-center">
                                <svg class="icon icon-xxs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                See all
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .calendar {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #e52d2d;
                border-radius: 12px;
                width: 70px;
                height: 70px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .calendar-month {
                font-size: 11px;
                font-weight: 800;
                text-transform: uppercase;
                color: white;
                padding: 3px 0;
                width: 100%;
                text-align: center;
            }

            .calendar-day {
                font-size: 24px;
                font-weight: 800;
                background-color: white;
                color: #333;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-bottom: 5px;
            }

            .h5 {
                font-weight: 700;
                color: #263238;
            }

            .text-gray-700 {
                color: #4b5563 !important;
            }

            @media (max-width: 767px) {
                .card-header h2 {
                    font-size: 1rem !important;
                    line-height: 1.2;
                }

                .card-header {
                    padding: 0.75rem !important;
                }

                .line-chart {
                    height: 250px !important;
                }
            }

            /* Proteksi agar teks tidak overflow */
            .card-header h2 {
                white-space: normal;
                word-wrap: break-word;
            }

            /* Warna Bar Chart dan Pie Chart per Fakultas */
            /* Rektorat - Green */
            .line-chart .ct-bar:nth-of-type(1),
            .pie-chart .ct-series-a .ct-slice-donut {
                stroke: #007F3B !important;
            }

            /* FEB - Orange */
            .line-chart .ct-bar:nth-of-type(2),
            .pie-chart .ct-series-b .ct-slice-donut {
                stroke: #fe9a20 !important;
            }

            /* FST - Dark Red */
            .line-chart .ct-bar:nth-of-type(3),
            .pie-chart .ct-series-c .ct-slice-donut {
                stroke: #810000 !important;
            }

            /* FIKES - Purple/Pink */
            .line-chart .ct-bar:nth-of-type(4),
            .pie-chart .ct-series-d .ct-slice-donut {
                stroke: #B33791 !important;
            }

            /* Custom Styling untuk Bar Chart agar lebih ramping */
            .line-chart .ct-bar {
                stroke-width: 15px;
            }
        </style>

    {{-- jumlah pelaporan kegiatan --}}
    @if(Auth::user()->is_admin == 1)
        <div class="row mt-4">
            <div class="col-12 col-xl-12">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="fs-5 fw-bold mb-0 text-capitalize">pelaporan kegiatan</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-bottom" scope="col">HUMAS DAN PUBLIKASI</th>
                                            <th class="border-bottom text-center" scope="col">JUMLAH PENGAJUAN</th>
                                            <th class="border-bottom text-center" scope="col">JUMLAH PELAPORAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-gray-900" scope="row">
                                                Rektorat
                                            </th>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $pengajuan_rektorat ?? 0 }}
                                            </td>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $publikasi_rektorat ?? 0 }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th class="text-gray-900" scope="row">
                                                Fakultas Ekonomi dan Bisnis
                                            </th>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $pengajuan_feb ?? 0 }}
                                            </td>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $publikasi_feb ?? 0 }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th class="text-gray-900" scope="row">
                                                Fakultas Sains dan Teknologi
                                            </th>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $pengajuan_fst ?? 0 }}
                                            </td>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $publikasi_fst ?? 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-gray-900" scope="row">
                                                Fakultas Ilmu Kesehatan
                                            </th>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $pengajuan_fikes ?? 0 }}
                                            </td>
                                            <td class="fw-bolder text-gray-500 text-center">
                                                {{ $publikasi_fikes ?? 0 }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end jumlah pelaporan kegiatan --}}
    @endif
    @endsection


    @push('scripts')
        <script>
            // Bar Chart: Pemantauan Kegiatan Per Fakultas (Accepted)
            new Chartist.Bar('.line-chart', {
                labels: ['Rektorat', 'FEB', 'FST', 'FIKES'],
                series: [
                    [{
                            meta: JSON.stringify({
                                unit: "Rektorat",
                                total: {{ $pengajuan_rektorat }},
                                items: @json($list_rektorat)
                            }),
                            value: {{ $pengajuan_rektorat }}
                        },
                        {
                            meta: JSON.stringify({
                                unit: "FEB",
                                total: {{ $pengajuan_feb }},
                                items: @json($list_feb)
                            }),
                            value: {{ $pengajuan_feb }}
                        },
                        {
                            meta: JSON.stringify({
                                unit: "FST",
                                total: {{ $pengajuan_fst }},
                                items: @json($list_fst)
                            }),
                            value: {{ $pengajuan_fst }}
                        },
                        {
                            meta: JSON.stringify({
                                unit: "FIKES",
                                total: {{ $pengajuan_fikes }},
                                items: @json($list_fikes)
                            }),
                            value: {{ $pengajuan_fikes }}
                        }
                    ]
                ]
            }, {
                low: 0,
                showArea: true,
                plugins: [
                    Chartist.plugins.tooltip({
                        class: 'chartist-tooltip',
                        appendToBody: true,
                        // Return the raw meta, the observer will transform it
                        transformTooltipTextFnc: function(meta) {
                            return meta;
                        }
                    })
                ],
                axisY: {
                    onlyInteger: true,
                    offset: 30
                },
                axisX: {
                    offset: 40
                }
            }, [
                ['screen and (max-width: 640px)', {
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            // Gunakan inisial/singkatan saja di mobile jika terlalu panjang
                            if (value === 'Rektorat') return 'Rekt';
                            if (value === 'Fakultas Ekonomi dan Bisnis') return 'FEB';
                            if (value === 'Fakultas Sains dan Teknologi') return 'FST';
                            if (value === 'Fakultas Ilmu Kesehatan') return 'FIKES';
                            return value;
                        }
                    }
                }]
            ]);

            // Pie Chart: Persentase Pengajuan Diterima
            var pieData = {
                series: [
                    {{ $pengajuan_rektorat }},
                    {{ $pengajuan_feb }},
                    {{ $pengajuan_fst }},
                    {{ $pengajuan_fikes }}
                ],
            };

            var sum = function(a, b) {
                return a + b;
            };

            new Chartist.Pie('.pie-chart', pieData, {
                labelInterpolationFnc: function(value) {
                    var total = pieData.series.reduce(sum);
                    if (total === 0) return '0%';
                    return Math.round(value / total * 100) + '%';
                },
                low: 0,
                donut: true,
                donutSolid: true,
                showLabel: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                chartPadding: 0,
            });

            function renderTooltipTable(data) {
                if (!data) return '';
                let unitName = data.unit || 'Fakultas';
                let totalCount = typeof data.total !== 'undefined' ? data.total : (data.items ? data.items.length : 0);

                let html = `
                    <div class="tooltip-table-wrapper">
                        <div class="tooltip-header">${unitName} — Total: ${totalCount} Kegiatan</div>
                        <table class="tooltip-table">
                            <thead>
                                <tr>
                                    <th>NAMA KEGIATAN</th>
                                    <th>WAKTU PELAKSANAAN</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                if (data.items && data.items.length > 0) {
                    data.items.forEach(item => {
                        let waktu = item.tgl;
                        if (item.tgl_akhir && item.tgl_akhir !== item.tgl) {
                            waktu += ` - ${item.tgl_akhir}`;
                        }
                        html += `
                            <tr>
                                <td>${item.nama}</td>
                                <td>${waktu}</td>
                                <td style="text-align:center">${item.total}</td>
                            </tr>
                        `;
                    });
                } else {
                    html += `<tr><td colspan="3" style="text-align:center; padding: 10px;">Tidak ada kegiatan</td></tr>`;
                }

                html += `
                            </tbody>
                        </table>
                    </div>
                `;
                return html;
            }

            function updateTooltipContent(node) {
                // If already containing the table wrapper, skip (to avoid recursive loops)
                if (node.querySelector('.tooltip-table-wrapper')) return;

                const rawContent = node.textContent || "";
                if (rawContent.includes('{"') && rawContent.includes('}')) {
                    const startIdx = rawContent.indexOf('{');
                    const endIdx = rawContent.lastIndexOf('}');

                    if (startIdx !== -1 && endIdx !== -1 && endIdx > startIdx) {
                        try {
                            const jsonStr = rawContent.substring(startIdx, endIdx + 1);
                            const data = JSON.parse(jsonStr);
                            node.innerHTML = renderTooltipTable(data);
                        } catch (e) {
                            // Silent fail for non-JSON content
                        }
                    }
                }
            }

            // Observer to fix tooltips
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        mutation.addedNodes.forEach(node => {
                            if (node.classList && node.classList.contains('chartist-tooltip')) {
                                updateTooltipContent(node);
                            }
                        });
                    }
                    if (mutation.target.classList && mutation.target.classList.contains('chartist-tooltip')) {
                        updateTooltipContent(mutation.target);
                    }
                });
            });
            observer.observe(document.body, {
                childList: true,
                subtree: true,
                characterData: true
            });

            // Live Search for Events
            const searchInput = document.getElementById('eventSearchInput');
            const eventsContainer = document.getElementById('eventsListContainer');
            const paginationContainer = document.getElementById('eventsPaginationContainer');
            let typingTimer;
            const doneTypingInterval = 500; // 0.5 seconds

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(performSearch, doneTypingInterval);
                });

                searchInput.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        clearTimeout(typingTimer);
                        performSearch();
                    }
                });
            }

            function performSearch() {
                const query = searchInput.value;
                const url = new URL(window.location.href);
                url.searchParams.set('search', query);
                url.searchParams.set('page', 1); // Reset to page 1 on new search

                // Update URL without reload
                window.history.pushState({}, '', url);

                // Fetch new data
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newEvents = doc.getElementById('eventsListContainer');
                        const newPagination = doc.getElementById('eventsPaginationContainer');

                        if (newEvents && eventsContainer) {
                            eventsContainer.innerHTML = newEvents.innerHTML;
                        }
                        if (newPagination && paginationContainer) {
                            paginationContainer.innerHTML = newPagination.innerHTML;
                        }
                    })
                    .catch(error => console.error('Error fetching events:', error));
            }
        </script>
        <style>
            .chartist-tooltip {
                position: absolute;
                display: block;
                min-width: 18rem;
                max-width: 30rem;
                padding: 0;
                background: rgba(0, 0, 0, 0.95);
                color: #fff;
                font-family: inherit;
                font-size: 0.8rem;
                border-radius: 0.5rem;
                pointer-events: none;
                z-index: 10000;
                text-align: left;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
                border: 1px solid rgba(255, 255, 255, 0.1);
                overflow: hidden;
            }

            .tooltip-table-wrapper {
                padding: 12px;
            }

            .tooltip-header {
                font-weight: 700;
                font-size: 0.9rem;
                margin-bottom: 10px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                padding-bottom: 6px;
                color: #FFEB3B;
            }

            .tooltip-table {
                width: 100%;
                border-collapse: collapse;
            }

            .tooltip-table th {
                text-align: left;
                padding: 6px 10px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                color: #bbb;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .tooltip-table td {
                padding: 8px 10px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                vertical-align: top;
            }

            .tooltip-table tr:last-child td {
                border-bottom: none;
            }
        </style>
    @endpush
