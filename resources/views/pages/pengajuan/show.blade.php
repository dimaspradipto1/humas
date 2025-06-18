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
        <li class="breadcrumb-item active text-capitalize" aria-current="page">pengajuan berita</li>
      </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
      <div class="mb-3 mb-lg-0">
        <h1 class="h4 text-capitalize">detail pengajuan berita</h1>
      </div>
      <div>
        <a href="{{ route('pengajuan.index') }}"
          class="btn btn-danger text-white d-inline-flex align-items-center">
            Back
        </a>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow mb-4">
    <div class="card-body">
      <div class="table-responsive" >
        <table class="table table-bordered">
          <tr>
            <th>Judul</th>
            <td>{{ $pengajuan->nama_kegiatan }}</td>
          </tr>
          <tr>
            <th>Tanggal Kegiatan</th>
            <td>{{ $pengajuan->tgl_awal }}</td>
          </tr>
          <tr>
            <th>Tanggal Selesai</th>
            <td>{{ $pengajuan->tgl_selesai }}</td>
          </tr>
          <tr>
            <th>Person In Charge (PIC)</th>
            <td>{{ $pengajuan->pic }}</td>
          </tr>
          <tr>
            <th>Jam Kegiatan</th>
            <td>{{ $pengajuan->jam_kegiatan }}WIB</td>
          </tr>
          <tr>
            <th>Lokasi</th>
            <td>{{ $pengajuan->link_zoom }}</td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td>{{ $pengajuan->deskripsi_kegiatan }}</td>
          </tr>
          <tr>
            <th>Unit Kegiatan</th>
            <td>{{ $pengajuan->unit_kegiatan }}</td>
          </tr>
          <tr>
            <th>Status Pengajuan</th>
            <td>{{ $pengajuan->status }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  
@endsection