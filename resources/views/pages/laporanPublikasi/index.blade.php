@extends('layouts.dashboard.template')

@section('content')
  <div class="py-4"></div>

  <div class="card border-0 shadow mb-4">
    <div class="card-body">
      <div class="card-block table-border-style">
        <form class="row g-3" action="{{ route('laporan-publikasi.show') }}" method="GET">
            <div class="row my-4">
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder="PERIODE" disabled>
              </div>
  
              <div class="col-md-3">
                <select name="tahun_akademik" id="tahun_akademik" class="form-select single">
                  <option value="">Pilih Tahun Akademik</option>
                  @foreach ($tahunAkademik as $tahun)
                    <option value="{{ $tahun->tahun_akademik }}"
                      {{ ($selectedPeriode ?? request('tahun_akademik')) == $tahun->tahun_akademik ? 'selected' : '' }}>
                      {{ $tahun->tahun_akademik }}
                    </option>
                  @endforeach
                </select>
              </div>
  
              <div class="col-md-1">
                <button type="submit" class="btn btn-secondary">CETAK</button>
              </div>
            </div>
          </form>
      </div>

      {!! $dataTable->table(['class' => 'table table-striped table-bordered w-100', 'id' => 'laporanpublikasi-table'], true) !!}
    </div>
  </div>
@endsection

@push('scripts')
  {!! $dataTable->scripts() !!}
@endpush
