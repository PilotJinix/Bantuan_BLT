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
//        dd($id, $data_kriteria, $cek_kriteria);



        $data_calon_penerima = DB::table('datapenerima')
            ->whereRaw("nik NOT IN (select kode_penerima from status_pengajuan where kode_unik_periode = '$kode_periode')")
            ->get();

//        dd($data_calon_penerima, $data_periode);

        $data_pengajuan = DB::table('status_pengajuan')
            ->select('status_pengajuan.*', 'datapenerima.nama', 'datapenerima.alamat')
            ->leftJoin('datapenerima', 'datapenerima.nik', 'status_pengajuan.kode_penerima')
//            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->get();
        return view('Admin.Informasi.detail', compact('data_pengajuan','data_calon_penerima', 'data_kriteria'));
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
