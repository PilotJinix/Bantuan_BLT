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

    public function insert_user(){
        $data_calon_penerima = DB::table('datapenerima')->get();
        return view('Admin.Informasi.detail', compact('data_calon_penerima'));
    }

    public function create_user(Request $request){
        dd($request);
    }

}
