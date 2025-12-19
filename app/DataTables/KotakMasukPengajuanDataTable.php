<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\KotakMasukPengajuan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
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
            ->addColumn('pengajuan.nama_kegiatan', function ($row) {
                return $row->pengajuan?->nama_kegiatan ?? '-';
            })
            ->editColumn('pengajuan.nama_kegiatan', function ($row) {
                $id = $row->pengajuan?->id;
                $nama = $row->pengajuan?->nama_kegiatan ?? '-';

                if (!$id) return $nama;

                return '<a href="' . route('pengajuan.edit', $id) . '" class="text-decoration-none text-success">'
                    . e($nama) .
                    '</a>';
            })
            ->addColumn('pengajuan.tgl_awal', function ($row) {
                if (!$row->pengajuan?->tgl_awal) return '-';
                Carbon::setLocale('id');
                return Carbon::parse($row->pengajuan->tgl_awal)->translatedFormat('l, d F Y');
            })
            ->addColumn('pengajuan.tgl_selesai', function ($row) {
                if (!$row->pengajuan?->tgl_selesai) return '-';
                Carbon::setLocale('id');
                return Carbon::parse($row->pengajuan->tgl_selesai)->translatedFormat('l, d F Y');
            })
            ->addColumn('pengajuan.status', function ($row) {
                $status = $row->pengajuan?->status;

                if ($status === 'pending') {
                    return '<span class="badge bg-warning px-2 rounded-pill px-3 py-2">Pending <i class="fa-solid fa-spinner"></i></span>';
                } elseif ($status === 'diterima') {
                    return '<span class="badge bg-success text-white px-2 rounded-pill px-3 py-2">Diterima <i class="fa-solid fa-check"></i></span>';
                } elseif ($status === 'ditolak') {
                    return '<span class="badge bg-danger text-white px-2 rounded-pill px-3 py-2">Ditolak <i class="fa-solid fa-xmark"></i></span>';
                }

                return '<span class="badge bg-secondary text-white px-2 rounded-pill px-3 py-2">-</span>';
            })
            ->addColumn('pengajuan.user_id', function ($row) {
                return $row->pengajuan?->user?->name ?? '-';
            })
            ->filter(function ($query) {
                if (request()->has('search') && request()->input('search')['value']) {
                    $search = request()->input('search')['value'];

                    $query->whereHas('pengajuan', function ($q) use ($search) {
                        $q->where('nama_kegiatan', 'like', "%{$search}%")
                          ->orWhere('tgl_awal', 'like', "%{$search}%")
                          ->orWhere('tgl_selesai', 'like', "%{$search}%")
                          ->orWhere('status', 'like', "%{$search}%")
                          ->orWhereHas('user', function ($uq) use ($search) {
                              $uq->where('name', 'like', "%{$search}%");
                          });
                    });
                }
            })
            ->rawColumns(['pengajuan.nama_kegiatan', 'pengajuan.status'])
            ->setRowId('DT_RowIndex');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KotakMasukPengajuan $model): QueryBuilder
    {
        $user   = auth()->user();
        $status = request('status'); // pending|diterima|ditolak|null

        // ✅ Load relasi yang benar
        $query = $model->newQuery()
            ->with(['pengajuan.user']) // penting: pengajuan & user-nya
            ->orderBy('created_at', 'desc');

        /**
         * ✅ Scope sesuai role (sesuaikan kebutuhan kamu):
         * - Admin lihat semua
         * - Operator fakultas lihat pengajuan sesuai fakultas user pengaju
         */
        if (!$user->is_admin) {
            $query->whereHas('pengajuan.user', function ($uq) use ($user) {
                if (!empty($user->is_feb)) {
                    $uq->where('is_feb', true);
                } elseif (!empty($user->is_fst)) {
                    $uq->where('is_fst', true);
                } elseif (!empty($user->is_fikes)) {
                    $uq->where('is_fikes', true);
                } elseif (!empty($user->is_rektorat)) {
                    $uq->where('is_rektorat', true);
                } else {
                    // kalau tidak punya role fakultas jelas, kosongkan supaya aman
                    $uq->whereRaw('1=0');
                }
            });
        }

        // ✅ Filter status harus ke tabel pengajuans
        if (!empty($status)) {
            $query->whereHas('pengajuan', function ($pq) use ($status) {
                $pq->where('status', $status);
            });
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $status = request('status'); // supaya kebawa ke AJAX

        return $this->builder()
            ->setTableId('kotak-masuk-pengajuan-table')
            ->columns($this->getColumns())
            ->ajax([
                'url'  => route('kotak-masuk-pengajuan.index'),
                'type' => 'GET',
                'data' => 'function(d){ d.status = "' . $status . '"; }',
            ])
            ->orderBy(2, 'desc')
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'searching' => true,
                'columnDefs' => [
                    [
                        'targets' => 1,
                        'width' => '400px',
                        'render' => 'function(data){ return "<div style=\'word-wrap:break-word;word-break:break-word;white-space:normal;overflow-wrap:break-word;\'>"+data+"</div>"; }'
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->addClass('text-center'),
            Column::make('pengajuan.nama_kegiatan')->title('Nama Kegiatan'),
            Column::make('pengajuan.tgl_awal')->title('Tanggal Kegiatan'),
            Column::make('pengajuan.tgl_selesai')->title('Tanggal Selesai'),
            Column::make('pengajuan.status')->title('Status Pengajuan'),
            Column::make('pengajuan.user_id')->title('Submit Pengguna'),
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
