<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_Kriteria extends Controller
{
    public function index($kode){
        $data_periode = DB::table("data_periode")
            ->where("kode_unik", $kode)
            ->first();

        $data_ke = DB::table("kriteria")
            ->where([
                "type_kriteria" =>"KE",
                "kode_unik"=> $kode
            ])
            ->get();
        $data_tk = DB::table("kriteria")
            ->where([
                "type_kriteria" =>"TK",
                "kode_unik"=> $kode
            ])
            ->get();
        $data_ppk = DB::table("kriteria")
            ->where([
                "type_kriteria" =>"PPK",
                "kode_unik"=> $kode
            ])
            ->get();
        $data_u = DB::table("kriteria")
            ->where([
                "type_kriteria" =>"U",
                "kode_unik"=> $kode
            ])
            ->get();
        $data_kkk = DB::table("kriteria")
            ->where([
                "type_kriteria" =>"KKK",
                "kode_unik"=> $kode
            ])
            ->get();

        return view("Admin.kriteria.index", compact("data_periode", "data_ke", "data_tk", "data_ppk", "data_u", "data_kkk"));
    }

    public function create_kriteria(Request $request, $kode){

//        dd($kode);
        $request->validate([
            "kriteria" => "required",
            "keterangan" => "required",
            "bobot" => "required",
        ]);

        try {
            $input["kode_unik"] = $kode;
            $input["type_kriteria"] = $request->kriteria;
            $input["keterangan"] = $request->keterangan;
            $input["bobot"] = $request->bobot;
            $input["created_at"] = Carbon::now();
            $input["updated_at"] = Carbon::now();

            DB::table("kriteria")->insert($input);
            return redirect(route("index_kriteria_admin", $kode));
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }

    public function edit_kriteria(Request $request, $id){
        $request->validate([
            "keterangan" => "required",
            "bobot" => "required",
        ]);

        try {
            $input["keterangan"] = $request->keterangan;
            $input["bobot"] = $request->bobot;
            $input["keterangan"] = $request->keterangan;
            $input["updated_at"] = Carbon::now();

            DB::table("kriteria")
                ->where("id", $id)
                ->update($input);
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
            return redirect()->back();
        }
    }

    public function delete_kriteria($id){
        try {
            DB::table("kriteria")->where("id", $id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
        }
    }
}
