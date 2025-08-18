@extends('layouts.dashboard.template')


@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active text-capitalize" aria-current="page">kinerja laporan kegiatan humas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4 text-capitalize">kinerja laporan kegiatan humas</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            #
        </div>
        <div class="card-block table-border-style">
            <form class="row g-3" action="#" method="GET">
                @csrf

                <div class="row my-4">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="PERIODE" disabled>
                        {{-- <select name="program_prodi" id="program_prodi" class="form-select single">
                              <option selected>-pilih program_prodi--</option>
                              <option value="all" {{ request('program_prodi') == 'all' ? 'selected' : '' }}>All</option>
                              <option value="Manajemen" {{ request('program_prodi') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                              <option value="Akuntansi" {{ request('program_prodi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                              <option value="Teknik Informatika" {{ request('program_prodi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                                Informatika</option>
                              <option value="Sistem Informasi" {{ request('program_prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem
                                Informasi</option>
                              <option value="Seni Tari" {{ request('program_prodi') == 'Seni Tari' ? 'selected' : '' }}>Seni Tari</option>
                              <option value="Seni Musik" {{ request('program_prodi') == 'Seni Musik' ? 'selected' : '' }}>Seni Musik</option>
                              <option value="Pendidikan Bahasa Mandarin"
                                {{ request('program_prodi') == 'Pendidikan Bahasa Mandarin' ? 'selected' : '' }}>Pendidikan Bahasa Mandarin
                              </option>
                              <option value="Teknik Industri" {{ request('program_prodi') == 'Teknik Industri' ? 'selected' : '' }}>Teknik
                                Industri</option>
                              <option value="Teknik Telekomunikasi" {{ request('program_prodi') == 'Teknik Telekomunikasi' ? 'selected' : '' }}>
                                Teknik Telekomunikasi</option>
                              <option value="Teknik Lingkungan" {{ request('program_prodi') == 'Teknik Lingkungan' ? 'selected' : '' }}>Teknik
                                Lingkungan</option>
                              <option value="Teknik Perangkat Lunak"
                                {{ request('program_prodi') == 'Teknik Perangkat Lunak' ? 'selected' : '' }}>Teknik Perangkat Lunak</option>
                            </select> --}}
                    </div>
                    {{--  <div class="col-md-2">
                            <select name="bulan_awal" id="bulan_awal" class="form-select single">
                              <option value="1" selected>januari</option>
                              <option value="2">februari</option>
                              <option value="3">maret</option>
                              <option value="4">april</option>
                              <option value="5">mei</option>
                              <option value="6">juni</option>
                              <option value="7">juli</option>
                              <option value="8">agustus</option>
                              <option value="9">september</option>
                              <option value="10">oktober</option>
                              <option value="11">november</option>
                              <option value="12">desember</option>
                            </select>
                          </div>  --}}
                    <div class="col-md-1">
                        <select name="tahun_awal" id="tahun_awal" class="form-select single">
                            @for ($year = 2014; $year <= date('Y'); $year++)
                                <option value="{{ $year }}" selected>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input class="form-control text-center text-uppercase font-weight-bold" placeholder="s/d">
                    </div>
                    <div class="col-md-1">
                        <select name="tahun_akhir" id="tahun_akhir" class="form-select single">
                            @for ($year = 2014; $year <= date('Y'); $year++)
                                <option value="{{ $year }}" selected>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">CETAK</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="card-block table-border-style">

            <div class="">
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table table-striped table-bordered w-100'], true) !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
