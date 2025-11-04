<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\KotakMasukPengajuan;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class KotakMasukPengajuanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('pengajuan.nama_kegiatan', function($kotakMasukPengajuan){
                return $kotakMasukPengajuan->pengajuan->nama_kegiatan;
            })
            ->editColumn('pengajuan.nama_kegiatan', function($kotakMasukPengajuan){
                return '<a href="'.route('pengajuan.edit', $kotakMasukPengajuan->pengajuan->id).'" class="text-decoration-none text-success">'.$kotakMasukPengajuan->pengajuan->nama_kegiatan.'</a>';
            })
            ->addColumn('pengajuan.tgl_awal', function($kotakMasukPengajuan){
                return Carbon::parse($kotakMasukPengajuan->pengajuan->tgl_awal)->translatedFormat('l, d F Y');
            })
            ->addColumn('pengajuan.tgl_selesai', function($kotakMasukPengajuan){
                return Carbon::parse($kotakMasukPengajuan->pengajuan->tgl_selesai)->translatedFormat('l, d F Y');
            })
            ->addColumn('pengajuan.status', function($kotakMasukPengajuan){
                if($kotakMasukPengajuan->pengajuan->status == 'pending'){
                    return '<span class="badge bg-warning px-2 rounded-pill px-3 py-2">Pending <i class="fa-solid fa-spinner"></i></span>';
                }elseif($kotakMasukPengajuan->pengajuan->status == 'diterima'){
                    return '<span class="badge bg-success text-white px-2 rounded-pill px-3 py-2">diterima <i class="fa-solid fa-check"></i></span>';
                }elseif($kotakMasukPengajuan->pengajuan->status == 'ditolak'){
                    return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">ditolak <i class="fa-solid fa-xmark"></i></span>';
                }
                return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">ditolak <i class="fa-solid fa-xmark"></i></span>';
            })
            ->addColumn('pengajuan.user_id', function($kotakMasukPengajuan){
                return $kotakMasukPengajuan->pengajuan->user->name;
            })
            ->rawColumns(['pengajuan.nama_kegiatan', 'pengajuan.tgl_awal', 'pengajuan.tgl_selesai', 'pengajuan.status', 'pengajuan.user_id'])
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KotakMasukPengajuan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('kotakmasukpengajuan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
           
            Column::make('DT_RowIndex')
                ->title('No')
                ->addClass('text-center'),
            Column::make('pengajuan.nama_kegiatan')
                ->title('Nama Kegiatan'),
            Column::make('pengajuan.tgl_awal')
                ->title('Tanggal Kegiatan'),
            Column::make('pengajuan.tgl_selesai')
                ->title('Tanggal Selesai'),
            Column::make('pengajuan.status')
                ->title('Status Pengajuan'),
            Column::make('pengajuan.user_id')
                ->title('Submit Pengguna'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KotakMasukPengajuan_' . date('YmdHis');
    }
}
