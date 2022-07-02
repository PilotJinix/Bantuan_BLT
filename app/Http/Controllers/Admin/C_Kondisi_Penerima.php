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
                ->addColumn('Aksi', function ($query){
                    if ($query->status == 1){
                        $action = '<a href="#" class="btn btn-outline-success btn-sm detail mr-2" title="Input Data Penerima"><i class="fa fa-user-circle-o"></i></a>';
                        $action .= '<a href="#" class="btn btn-outline-warning btn-sm detail mr-2" title="Edit Periode"><i class="fa fa-pencil"></i></a>';
                        $action .= '<a href="#" class="btn btn-outline-danger btn-sm detail mr-2" title="Delete Periode"><i class="fa fa-trash"></i></a>';
                    }else{
                        $action = '<a href="#" class="btn btn-outline-warning btn-sm detail mr-2" title="Edit Periode"><i class="fa fa-pencil"></i></a>';
                        $action .= '<a href="#" class="btn btn-outline-danger btn-sm detail mr-2" title="Delete Periode"><i class="fa fa-trash"></i></a>';
                    }
                    return $action;
                })
                ->escapeColumns([])
                ->make(true);

            return $data_versi;
        }

        return view('Admin.Informasi.index', compact('data_skala'));
    }

    public function create_periode(Request $request){
        $request->validate([
            "versi" => "required",
            "nama_periode" => "required",
            "period" => "required",
            "kuota" => "required",
            "status" => "required",
        ]);

        try {
            $input['kode_unik_skala'] = $request->versi;
            $input["kode_unik"] = Uuid::uuid1()->toString();
            $input["nama"] = $request->nama_periode;
            $input["periode"] = $request->period;
            $input["kuota"] = $request->kuota;
            $input["status"] = $request->status;
            $input["created_at"] = Carbon::now();
            $input["updated_at"] = Carbon::now();

            DB::table("data_periode")->insert($input);
            return response()->json(array("status" => 'good', "msg" => ""));
        }catch (\Exception $exception){
            return response()->json(array("status" => 'Galat', "msg" => ""));
        }
    }
}
