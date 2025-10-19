<?php

namespace App\DataTables;

use App\Models\LaporanPublikasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LaporanPublikasiDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('tahun_akademik', fn ($row) =>
                $row->publikasi?->tahunAkademik?->tahun_akademik ?? '-'
            )
            ->addColumn('submit_pengguna', fn ($row) =>
                $row->user?->name ?? '-'
            )
            ->addColumn('nama_kegiatan', fn ($row) =>
                $row->publikasi?->pengajuan?->nama_kegiatan ?? '-'
            )
            ->addColumn('tgl_awal', fn ($row) =>
                $row->publikasi?->pengajuan?->tgl_awal ?? '-'
            )
            ->addColumn('tgl_selesai', fn ($row) =>
                $row->publikasi?->pengajuan?->tgl_selesai ?? '-'
            )
            ->addColumn('deskripsi_kegiatan', fn ($row) =>
                $row->publikasi?->pengajuan?->deskripsi_kegiatan ?? '-'
            )
            ->addColumn('link_zoom', fn ($row) =>
                $row->publikasi?->pengajuan?->link_zoom ?? '-'
            )
            ->addColumn('link_dokumen', fn ($row) =>
                $row->publikasi?->pengajuan?->link_dokumen ?? '-'
            )
            ->setRowId('id');
    }

    public function query(LaporanPublikasi $model): QueryBuilder
    {
        return $model->newQuery()
            ->with([
                'user',
                'publikasi.tahunAkademik',
                'publikasi.pengajuan',
            ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('laporanpublikasi-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('laporan-publikasi.index'))
            ->parameters([
                'scrollX' => true,
                'processing' => true,
                'serverSide' => true,
                'order'      => [],
                'lengthMenu' => [[10,25,50,-1],[10,25,50,'All']],
            ])
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No'),
            Column::make('tahun_akademik')->title('Tahun Akademik'),
            Column::make('submit_pengguna')->title('Submit Pengguna'),
            Column::make('nama_kegiatan')->title('Nama Kegiatan'),
            Column::make('tgl_awal')->title('Tanggal Awal'),
            Column::make('tgl_selesai')->title('Tanggal Selesai'),
            Column::make('deskripsi_kegiatan')->title('Deskripsi Kegiatan'),
            Column::make('link_zoom')->title('Link Zoom'),
            Column::make('link_dokumen')->title('Link Dokumen'),
        ];
    }

    protected function filename(): string
    {
        return 'LaporanPublikasi_' . date('YmdHis');
    }
}
