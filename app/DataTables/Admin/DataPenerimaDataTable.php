<?php

namespace App\DataTables\Admin;

use App\App\Admin\DataPenerima;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DataPenerimaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $data_kriteria['periode'] = DB::table('data_periode')
            ->where('id', $this->id)
            ->first();

//        dd($data_kriteria['periode']);

        $data_kriteria['kriteria'] = DB::table('master_kriteria')
            ->where('kode_unik_skala', $data_kriteria['periode']->kode_unik_skala)
            ->get();

        $cek_kriteria = array_column($data_kriteria['kriteria']->toArray(), 'kode_unik');

        $data_kriteria['sub_kriteria'] = DB::table('master_sub_kriteria')
            ->whereIn('kode_unik_kriteria', $cek_kriteria)
            ->get();



        $data_pengajuan = DB::table('status_pengajuan')
            ->select('status_pengajuan.*', 'datapenerima.nama', 'datapenerima.alamat', DB::raw('(CASE WHEN status_pengajuan.kode_unik = hasil_jawaban.kode_pengajuan THEN 1 ELSE 0 END) AS is_hasil'))
            ->leftJoin('datapenerima', 'datapenerima.nik', 'status_pengajuan.kode_penerima')
            ->leftJoin('data_periode', 'data_periode.kode_unik', 'status_pengajuan.kode_unik_periode')
            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
//            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->distinct();
//            ->get();

//        dd($data_pengajuan);

        $data_pengajuan_edit = DB::table('hasil_jawaban')
            ->select('hasil_jawaban.*', 'master_sub_kriteria.kode_unik_kriteria as kriteria')
            ->leftJoin('status_pengajuan', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->leftJoin('master_sub_kriteria', 'hasil_jawaban.kode_kriteria', 'master_sub_kriteria.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
            ->distinct()
            ->get();
        return datatables()
            ->query($data_pengajuan)
            ->addIndexColumn()
            ->addColumn('status', function ($query){
                if ($query->is_hasil == '1'){
                    $status ='<a href="javascript:void(0)" class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Data Telah Terinput</a>';
                }else{
                    $status = '<a href="javascript:void(0)" class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-warning">Tidak Ditemukan</a>';
                }
                return $status;
            })
//            ->addColumn('action', 'Admin/Data_Penerima/aksi2', compact('data_pengajuan_edit', 'data_kriteria'))
            ->addColumn('action', function ($model) use ($data_pengajuan, $data_pengajuan_edit, $data_kriteria){
                return view('Admin/Data_Penerima/aksi2', compact('data_pengajuan', 'data_pengajuan_edit', 'data_kriteria', 'model'));
            })
            ->escapeColumns([]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('admin\datapenerima-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            Column::computed('action')
//                  ->exportable(false)
//                  ->printable(false)
//                  ->width(60)
//                  ->addClass('text-center'),
//            Column::make('id'),
//            Column::make('add your columns'),
//            Column::make('created_at'),
//            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin\DataPenerima_' . date('YmdHis');
    }
}
