<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Pengajuan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PengajuanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $user = auth()->user();
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->editColumn('tgl_kegiatan', function($pengajuan){
                return date('d M Y', strtotime($pengajuan->tgl_kegiatan));
            })
            ->editColumn('tgl_selesai', function($pengajuan){
                return date('d M Y', strtotime($pengajuan->tgl_selesai));
            })
            ->editColumn('user_id', function($pengajuan){
                return $pengajuan->user->name;
            })
            ->editColumn('status', function($pengajuan){
                if($pengajuan->status == 'pending'){
                    return '<span class="badge bg-warning px-2 rounded-pill px-3 py-2">Pending <i class="fa-solid fa-spinner"></i></span>';
                }elseif($pengajuan->status == 'disetujui'){
                    return '<span class="badge bg-success text-white px-2 rounded-pill px-3 py-2">disetujui <i class="fa-solid fa-check"></i></span>';
                }elseif($pengajuan->status == 'ditolak'){
                    return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">ditolak <i class="fa-solid fa-xmark"></i></span>';
                }
            })
            ->addColumn('action', function($pengajuan) use ($user){
                if($user->is_admin){
                    return '
                    <a href="'.route('pengajuan.edit', $pengajuan->id).'" class="btn btn-sm btn-warning text-white px-3" ><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form action="'.route('pengajuan.destroy', $pengajuan->id).'" method="POST" style="display: inline">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confrm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can"></i> delete</button>
                    </form>
                    ';
                }
                return '
                <a href="'.route('pengajuan.show', $pengajuan->id).'" class="btn btn-sm btn-primary text-white px-3" ><i class="fa-solid fa-eye"></i> Detail</a>
                ';
            })
            ->rawColumns(['action', 'tgl_kegiatan', 'tgl_selesai', 'status', 'user_id'])
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengajuan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    // ->parameters([
                    //     'scrollX'=>true,
                    // ])
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
            Column::make('nama_kegiatan')->title('Nama Kegiatan'),
            Column::make('tgl_kegiatan')->title('Tanggal Kegiatan'),
            Column::make('tgl_selesai')->title('Tanggal Selesai'),
            // Column::make('pic')->title('Person In Charge (PIC)'),
            Column::make('status')->title('Status Pengajuan'),
            Column::make('user_id')->title('Submit Pengguna'),
            Column::computed('action')
            ->title('Aksi')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];

    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengajuan_' . date('YmdHis');
    }
}
