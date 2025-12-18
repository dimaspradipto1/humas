<?php

namespace App\DataTables;

use Carbon\Carbon;
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
    // public function dataTable(QueryBuilder $query): EloquentDataTable
    // {
    //     $user = auth()->user();
    //     if ($user->is_admin) {
    //         $query = Pengajuan::query();
    //     } else if ($user->is_feb || $user->is_fst || $user->is_fikes || $user->is_rektorat) {
    //         $query = Pengajuan::where('user_id', $user->id);
    //     }

    //     return (new EloquentDataTable($query))
    //         ->addIndexColumn()
    //         ->addColumn('DT_RowIndex', '')
    //         ->addColumn('tgl_awal', function ($pengajuan) {
    //             Carbon::setLocale('id');
    //             return Carbon::parse($pengajuan->tgl_awal)->translatedFormat('l, d F Y');
    //         })
    //         ->editColumn('tgl_selesai', function ($pengajuan) {
    //             Carbon::setLocale('id');
    //             return Carbon::parse($pengajuan->tgl_selesai)->translatedFormat('l, d F Y');
    //         })
    //         ->editColumn('user_id', function ($pengajuan) use ($user) {
    //             return $user->is_admin ? $pengajuan->user->name : '';
    //         })
    //         ->editColumn('status', function ($pengajuan) {
    //             if ($pengajuan->status == 'pending') {
    //                 return '<span class="badge bg-warning px-2 rounded-pill px-3 py-2">Pending <i class="fa-solid fa-spinner"></i></span>';
    //             } elseif ($pengajuan->status == 'diterima') {
    //                 return '<span class="badge bg-success text-white px-2 rounded-pill px-3 py-2">diterima <i class="fa-solid fa-check"></i></span>';
    //             } elseif ($pengajuan->status == 'ditolak') {
    //                 return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">ditolak <i class="fa-solid fa-xmark"></i></span>';
    //             }
    //         })
    //         ->addColumn('action', function ($pengajuan) use ($user) {

    //             return '
    //                 <a href="' . route('pengajuan.show', $pengajuan->id) . '" class="btn btn-sm btn-primary text-white px-3" ><i class="fa-solid fa-eye"></i></a>
    //                 <a href="' . route('pengajuan.edit', $pengajuan->id) . '" class="btn btn-sm btn-warning text-white px-3" ><i class="fa-solid fa-pen-to-square"></i></a>
    //                 <form action="' . route('pengajuan.destroy', $pengajuan->id) . '" method="POST" style="display: inline">
    //                     ' . csrf_field() . '
    //                     ' . method_field('DELETE') . '
    //                     <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confrm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can"></i></button>
    //                 </form>
    //                 ';

    //             return '
    //             <a href="' . route('pengajuan.show', $pengajuan->id) . '" class="btn btn-sm btn-primary text-white px-3" ><i class="fa-solid fa-eye"></i></a>
    //             ';
    //         })
    //         ->rawColumns(['action', 'tgl_awal', 'tgl_selesai', 'status', 'user_id'])
    //         ->setRowId('DT_RowIndex');
    // }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $user = auth()->user();

        // Kondisi untuk menentukan query berdasarkan tipe pengguna
        if ($user->is_admin) {
            $query = Pengajuan::query(); // Admin bisa melihat semua data
        } else if ($user->is_feb || $user->is_fst || $user->is_fikes || $user->is_rektorat) {
            $query = Pengajuan::where('user_id', $user->id); // Pengguna biasa hanya bisa melihat pengajuan miliknya
        }

        // Membuat objek EloquentDataTable
        return (new EloquentDataTable($query))
            ->addIndexColumn() // Menambahkan kolom indeks
            ->addColumn('DT_RowIndex', '') // Menambahkan kolom kosong untuk keperluan row index
            ->addColumn('tgl_awal', function ($pengajuan) {
                Carbon::setLocale('id');
                return Carbon::parse($pengajuan->tgl_awal)->translatedFormat('l, d F Y');
            })
            ->editColumn('tgl_selesai', function ($pengajuan) {
                Carbon::setLocale('id');
                return Carbon::parse($pengajuan->tgl_selesai)->translatedFormat('l, d F Y');
            })
            ->editColumn('user_id', function ($pengajuan) use ($user) {
                return $user->is_admin ? $pengajuan->user->name : '';
            })
            ->editColumn('status', function ($pengajuan) {
                // Menampilkan status pengajuan dengan badge yang berbeda
                if ($pengajuan->status == 'pending') {
                    return '<span class="badge bg-warning px-2 rounded-pill px-3 py-2">Pending <i class="fa-solid fa-spinner"></i></span>';
                } elseif ($pengajuan->status == 'diterima') {
                    return '<span class="badge bg-success text-white px-2 rounded-pill px-3 py-2">Diterima <i class="fa-solid fa-check"></i></span>';
                } elseif ($pengajuan->status == 'ditolak') {
                    return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">Ditolak <i class="fa-solid fa-xmark"></i></span>';
                }
            })
            ->addColumn('action', function ($pengajuan) use ($user) {
                // Kolom aksi yang bisa dilihat oleh admin dan pengguna yang berhak
                $action = '<a href="' . route('pengajuan.show', $pengajuan->id) . '" class="btn btn-sm btn-primary text-white px-3"><i class="fa-solid fa-eye"></i></a>';

                if ($user->is_admin) {
                    $action .= '
                    <a href="' . route('pengajuan.edit', $pengajuan->id) . '" class="btn btn-sm btn-warning text-white px-3"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="' . route('pengajuan.destroy', $pengajuan->id) . '" method="POST" style="display: inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>';
                }

                return $action;
            })
            ->rawColumns(['action', 'tgl_awal', 'tgl_selesai', 'status', 'user_id']) // Menyertakan kolom dengan HTML dalam hasil
            ->setRowId('DT_RowIndex'); // Mengatur ID untuk setiap baris
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
        // Mengurutkan berdasarkan 'created_at' secara menurun (terbaru di atas)
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengajuan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // Mengurutkan berdasarkan kolom 0, yang adalah 'created_at', secara menurun
            ->orderBy(2, 'desc')  // Pastikan ini sesuai dengan kolom yang Anda urutkan, biasanya kolom kedua tgl_awal
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'columnDefs' => [
                    [
                        'targets' => 1,
                        'width' => '250px',
                        'render' => 'function(data, type, row, meta) { return "<div style=\'word-wrap: break-word; word-break: break-word; white-space: normal; overflow-wrap: break-word;\' >" + data + "</div>"; }'
                    ],
                    [
                        'targets' => 0,
                        'width' => '5px',
                        'className' => 'text-start',
                        'render' => null
                    ],
                    [
                        'targets' => 4,
                        'width' => '10px',
                        'className' => 'text-center',
                        'style' => 'text-align: text-left;',
                        'render' => null
                    ]
                ],
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

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No'),
            Column::make('nama_kegiatan')->title('Nama Kegiatan')->addClass('text-start'),
            Column::make('tgl_awal')->title('Tanggal Kegiatan')->width(20),
            Column::make('tgl_selesai')->title('Tanggal Selesai')->width(20),
            Column::make('status')->title('Status Pengajuan'),
            Column::make('user_id')->title('Submit Pengguna')->visible(auth()->user()->is_admin)->width(5),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width(40)->addClass('text-center'),
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
