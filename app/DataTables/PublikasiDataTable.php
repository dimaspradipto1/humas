<?php

namespace App\DataTables;

use App\Models\Publikasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PublikasiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    // public function dataTable(QueryBuilder $query): EloquentDataTable
    // {
    //     if(auth()->user()->is_admin){
    //         $query = Publikasi::query();
    //     }else{
    //         // $query = Publikasi::where('user_id', auth()->user()->id);
    //         $query = Publikasi::with('pengajuan')->where('user_id', auth()->user()->id);
    //     }
        
    //     return (new EloquentDataTable($query))
    //         ->addIndexColumn()
    //         ->addColumn('DT_RowIndex', '')
    //         ->addColumn('tgl_awal', function($publikasi){
    //             return date('d-m-Y', strtotime($publikasi->tgl_awal));
    //         })
    //         ->editColumn('pengajuan_id', fn($p) => $p->pengajuan->nama_kegiatan ?? '-')
    //         ->addColumn('tgl_akhir', function($publikasi){
    //             return date('d-m-Y', strtotime($publikasi->tgl_akhir));
    //         })
    //         ->editColumn('upload_laporan', function($publikasi){
    //             return $publikasi->upload_laporan ? '
    //                 <a href="'.$publikasi->upload_laporan.'" target="_blank" class="text-success px-3 me-1" ><i class="fa-solid fa-eye"></i> Lihat Laporan</a>
    //             ' : '-';
    //         })
    //         ->editColumn('tahun_akademik_id', function($item){
    //             return $item->tahun_akademik ? $item->tahun_akademik->tahun_akademik : '-';
    //         })
    //         ->addColumn('user_id', function($publikasi){
    //             return $publikasi->user->name;
    //         })
    //         ->editColumn('link_dokumentasi', function($publikasi){
    //             return $publikasi->link_dokumentasi ? '<a href="'.$publikasi->link_dokumentasi.'" target="_blank" class="text-secondary px-3 me-1" ><i class="fa-solid fa-eye"></i> Lihat Dokumentasi</a>' : '-';
    //         })
    //         ->editColumn('link_publikasi', function($publikasi){
    //             return $publikasi->link_publikasi ? '<a href="'.$publikasi->link_publikasi.'" target="_blank" class="text-success px-3 me-1" ><i class="fa-solid fa-eye"></i> Lihat Publikasi</a>' : '-';
    //         })
    //         ->addColumn('action', function($publikasi){
    //             return '
    //                 <a href="'.route('publikasi.show', $publikasi->id).'" class="btn btn-sm btn-info text-white px-3" ><i class="fa-solid fa-eye"></i> Detail</a>
    //                 <a href="'.route('publikasi.edit', $publikasi->id).'" class="btn btn-sm btn-warning text-white px-3" ><i class="fa-solid fa-pen-to-square"></i> Edit</a>
    //                 <form action="'.route('publikasi.destroy', $publikasi->id).'" method="POST" style="display: inline">
    //                     '.csrf_field().'
    //                     '.method_field('DELETE').'
    //                     <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confrm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can"></i> Delete</button>
    //                 </form>
    //             ';
    //         })
    //         ->rawColumns(['action', 'tgl_awal', 'tgl_akhir', 'upload_laporan', 'link_dokumentasi', 'link_publikasi', 'user_id', 'tahun_akademik_id', 'pengajuan_id'])
    //         ->setRowId('DT_RowIndex');
    // }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        if(auth()->user()->is_admin){
            $query = Publikasi::query(); // Admin query seluruh publikasi
        } else {
            // Untuk pengguna biasa, ambil hanya yang sesuai dengan user_id mereka
            $query = Publikasi::with('pengajuan')
                ->where('publikasis.user_id', auth()->user()->id); // Menambahkan alias 'publikasis' untuk menghindari konflik dengan pengajuan
        }

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('DT_RowIndex', '')
            ->addColumn('tgl_awal', function($publikasi){
                return date('d-m-Y', strtotime($publikasi->tgl_awal));
            })
            ->editColumn('pengajuan_id', function($publikasi) {
                return $publikasi->pengajuan ? $publikasi->pengajuan->nama_kegiatan : '-'; // Ambil nama_kegiatan dari tabel pengajuan
            })
            ->addColumn('tgl_akhir', function($publikasi){
                return date('d-m-Y', strtotime($publikasi->tgl_akhir));
            })
            ->editColumn('upload_laporan', function($publikasi){
                return $publikasi->upload_laporan ? '<a href="'.$publikasi->upload_laporan.'" target="_blank" class="text-success px-3 me-1"><i class="fa-solid fa-eye"></i> Lihat Laporan</a>' : '-';
            })
            ->editColumn('tahun_akademik_id', function($item){
                return $item->tahun_akademik ? $item->tahun_akademik->tahun_akademik : '-';
            })
            ->addColumn('user_id', function($publikasi){
                return $publikasi->user->name;
            })
            ->editColumn('link_dokumentasi', function($publikasi){
                return $publikasi->link_dokumentasi ? '<a href="'.$publikasi->link_dokumentasi.'" target="_blank" class="text-secondary px-3 me-1"><i class="fa-solid fa-eye"></i> Lihat Dokumentasi</a>' : '-';
            })
            ->editColumn('link_publikasi', function($publikasi){
                return $publikasi->link_publikasi ? '<a href="'.$publikasi->link_publikasi.'" target="_blank" class="text-success px-3 me-1"><i class="fa-solid fa-eye"></i> Lihat Publikasi</a>' : '-';
            })
            ->addColumn('action', function($publikasi){
                return '
                    <a href="'.route('publikasi.show', $publikasi->id).'" class="btn btn-sm btn-info text-white px-3"><i class="fa-solid fa-eye"></i> Detail</a>
                    <a href="'.route('publikasi.edit', $publikasi->id).'" class="btn btn-sm btn-warning text-white px-3"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form action="'.route('publikasi.destroy', $publikasi->id).'" method="POST" style="display: inline">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confrm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['action', 'tgl_awal', 'tgl_akhir', 'upload_laporan', 'link_dokumentasi', 'link_publikasi', 'user_id', 'tahun_akademik_id', 'pengajuan_id'])
            ->setRowId('DT_RowIndex');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Publikasi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('publikasi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'scrollX' => true,
                    ])
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
            Column::make('pengajuan.nama_kegiatan')->title('Nama Kegiatan'),
            Column::make('tgl_awal')->title('Tanggal Awal'),
            Column::make('tgl_akhir')->title('Tanggal Selesai'),
            // Column::make('upload_laporan')->title('Upload Laporan'),
            // Column::make('link_dokumentasi')->title('Link Dokumentasi'),
            // Column::make('link_publikasi')->title('Link Publikasi'),
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
        return 'Publikasi_' . date('YmdHis');
    }
}
