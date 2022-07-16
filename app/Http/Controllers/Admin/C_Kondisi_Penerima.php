<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class C_Kondisi_Penerima extends Controller
{
    public function index(Request $request){
        $data_skala = DB::table("master_skala")->get();
        if ($request->ajax()){
            $data_versi = DataTables::of(DB::table("data_periode")
                ->where('kode_unik_skala', $request->versi))
                ->addColumn('data_status', function ($query){
                    if ($query->status == 1){
                        $status = "<span class='badge badge-success-inverse'>"."Aktif"."</span>";
                    }else{
                        $status = "<span class='badge badge-danger-inverse'>"."Tidak Aktif"."</span>";
                    }
                    return $status;
                })
                ->addColumn('Aksi', 'Admin.Informasi.aksi')
                ->escapeColumns([])
                ->make(true);

            return $data_versi;
        }

        return view('Admin.Informasi.index', compact('data_skala'));
    }

    public function insert_user($id){
//        $data_periode = DB::table('data_periode')
//            ->where('id', $id)
//            ->first();

        $data_kriteria['periode'] = DB::table('data_periode')
            ->where('id', $id)
            ->first();

        $data_kriteria['kriteria'] = DB::table('master_kriteria')
            ->where('kode_unik_skala', $data_kriteria['periode']->kode_unik_skala)
            ->get();

        $cek_kriteria = array_column($data_kriteria['kriteria']->toArray(), 'kode_unik');


        $data_kriteria['sub_kriteria'] = DB::table('master_sub_kriteria')
            ->whereIn('kode_unik_kriteria', $cek_kriteria)
            ->get();

        $kode_periode = $data_kriteria['periode']->kode_unik;

        $data_calon_penerima = DB::table('datapenerima')
            ->whereRaw("nik NOT IN (select kode_penerima from status_pengajuan where kode_unik_periode = '$kode_periode')")
            ->get();

//        dd($data_calon_penerima, $data_periode);

        $data_pengajuan = DB::table('status_pengajuan')
            ->select('status_pengajuan.*', 'datapenerima.nama', 'datapenerima.alamat', DB::raw('(CASE WHEN status_pengajuan.kode_unik = hasil_jawaban.kode_pengajuan THEN 1 ELSE 0 END) AS is_hasil'))
            ->leftJoin('datapenerima', 'datapenerima.nik', 'status_pengajuan.kode_penerima')
            ->leftJoin('data_periode', 'data_periode.kode_unik', 'status_pengajuan.kode_unik_periode')
            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
//            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->distinct()
            ->get();

//        dd($data_pengajuan);

        $data_pengajuan_edit = DB::table('hasil_jawaban')
            ->select('hasil_jawaban.*', 'master_sub_kriteria.kode_unik_kriteria as kriteria')
            ->leftJoin('status_pengajuan', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->leftJoin('master_sub_kriteria', 'hasil_jawaban.kode_kriteria', 'master_sub_kriteria.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
            ->distinct()
            ->get();
//        dd($data_kriteria['kriteria'],$data_pengajuan_edit, $data_kriteria['sub_kriteria']);

//        dd($data_pengajuan);
        return view('Admin.Informasi.detail', compact('data_pengajuan','data_calon_penerima', 'data_kriteria', 'data_pengajuan_edit'));
    }

    public function create_user(Request $request, $kode_unik){
        $data = array_unique($request->multiple);
//        dd($data, $kode_unik);

        foreach ($data as $items){
            $input['kode_unik_periode'] = $kode_unik;
            $input['kode_penerima'] = $items;
            $input['kode_unik'] = Uuid::uuid1()->toString();
            $input['status'] = 'Data Belum Terinput';
            $input['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
            $input['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');
            DB::table('status_pengajuan')->insert($input);
        }

        return redirect()->back();
    }

    public function create_hasil(Request $request, $kode){
//        dd($request);
        foreach ($request->status as $items){
            $input['kode_kriteria'] =$items;
            $input['jawaban'] =$items;
            $input['kode_pengajuan'] =$kode;
            $input['created_at'] = Carbon::now()->format('Y-m-d h:i:s');
            $input['updated_at'] = Carbon::now()->format('Y-m-d h:i:s');

            DB::table('hasil_jawaban')->insert($input);
        }

        return redirect()->back();
    }

}
