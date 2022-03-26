<?php

namespace App\Http\Controllers\Admin;

use App\DataPenerima;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class C_Periode extends Controller
{
    public function index(Request $request){
        $request->validate([
            "kuota"=>"required",
            "nama"=>"required",
            "status"=>"required",
        ]);

        $input["kode_unik"] = Uuid::uuid1()->toString();
        $input["nama"] = $request->nama;
        $input["kuota"] = $request->kuota;
        $input["status"] = $request->status;
        $input["created_at"] = Carbon::now();
        $input["updated_at"] = Carbon::now();

        try {
            DB::table("data_periode")->insert($input);
            return redirect(route("/"));
        }catch (\Exception $exception){
            return redirect()->back();

        }
    }

    public function edit_periode(Request $request, $kode){
        $request->validate([
            "kuota"=>"required",
            "nama"=>"required",
            "status"=>"required",
        ]);

        $input["nama"] = $request->nama;
        $input["kuota"] = $request->kuota;
        $input["status"] = $request->status;
        $input["updated_at"] = Carbon::now();

        try {
            DB::table("data_periode")->where("kode_unik", $kode)->update($input);
            return redirect(route("/"));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }

    public function delete_periode($kode){
        try {
            DB::table("data_periode")->where("kode_unik", $kode)->delete();
            return redirect(route("/"));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }
}
