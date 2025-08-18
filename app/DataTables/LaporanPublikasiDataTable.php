<?php

namespace App\DataTables;

use App\Models\LaporanPublikasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanPublikasiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // if ($tahun_akademik = request('tahun_akademik')) {
        //     $query->where('publikasi.tahun_akademik', $tahun_akademik); // Filter berdasarkan tahun akademik
        // }
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
             ->editColumn('fakultas', function($row) {
                return $row->user ? $row->user->fakultas : 'N/A'; 
            })
            ->editColumn('tahun_akademik', function($item){
                return $item->publikasi ? $item->publikasi->tahunAkademik->tahun_akademik : 'N/A';  // Get academic year name from relation
            })
            // ->addColumn('action', 'laporanpublikasi.action')
            ->rawColumns(['action',])
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LaporanPublikasi $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'publikasi');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('laporanpublikasi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(2)
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
            Column::make('DT_RowIndex')->title('No'),
            Column::make('tahun_akademik')->title('tahun_akademik'),
            Column::make('user.fakultas')->title('Fakultas'),
            Column::make('nama_kegiatan')->title('Nama Kegiatan'),
            Column::make('link_dokumentasi')->title('Link Dokumen'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LaporanPublikasi_' . date('YmdHis');
    }
}
