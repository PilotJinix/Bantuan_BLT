<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class C_Test extends Controller
{
    // Skala
    public function index_skala(){
        $data_skala = DB::table("master_skala")->get();
        return view("Test.skala.index", compact("data_skala"));
    }

    public function create_skala(Request $request){
        $request->validate([
            "nama_versi" => "required"
        ]);

        try {
            $input["kode_unik"] = Uuid::uuid1()->toString();
            $input["versi"] = $request->nama_versi;
            $input["created_at"] = Carbon::now();
            $input["updated_at"] = Carbon::now();

            DB::table("master_skala")->insert($input);
            return redirect(route("index_skala"));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function edit_skala(Request $request, $id){
        $request->validate([
            "nama_versi" => "required"
        ]);

        try {
            $input["versi"] = $request->nama_versi;
            $input["updated_at"] = Carbon::now();

            DB::table("master_skala")->where("id", $id)->update($input);
            return redirect(route("index_skala"));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function delete_skala($id){
        try {
            DB::table("master_skala")->where("id", $id)->delete();
            return redirect(route("index_skala"));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    //  Kriteria
    public function index_kriteria($kode_skala){
        $data_skala = DB::table("master_skala")->where("kode_unik", $kode_skala)->first();

        $data_kriteria = DB::table("master_kriteria")->where("kode_unik_skala", $kode_skala)->get();

        return view("Test.skala.detail", compact("data_skala", "data_kriteria"));

    }

    public function create_kriteria(Request $request, $kode_skala){
        $request->validate([
            "nama_kriteria" => "required",
            "nama_kode" => "required",
        ]);

        try {
            $input["kode_unik_skala"] = $kode_skala;
            $input["kode_unik"] = Uuid::uuid1()->toString();
            $input["nama_kriteria"] = $request->nama_kriteria;
            $input["kode"] = $request->nama_kode;
            $input["created_at"] = Carbon::now();
            $input["updated_at"] = Carbon::now();

            DB::table("master_kriteria")->insert($input);
            return redirect(route("index_kriteria", $kode_skala));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function edit_kriteria(Request $request, $id){
        $request->validate([
            "nama_kriteria" => "required",
            "nama_kode" => "required",
        ]);

        try {
            $input["nama_kriteria"] = $request->nama_kriteria;
            $input["kode"] = $request->nama_kode;
            $input["updated_at"] = Carbon::now();

            DB::table("master_kriteria")->where("id", $id)->update($input);
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function delete_kriteria($id){
        try {
            DB::table("master_kriteria")->where("id", $id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
        }
    }
}
