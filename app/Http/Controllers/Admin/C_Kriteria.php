<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_Kriteria extends Controller
{
    public function index(){

        $data_user = DB::table("datapenerima")
            ->whereRaw("nik NOT IN (select detail_data_penerima.nik from detail_data_penerima)")
            ->get();

        $data = [];

        foreach ($data_user as $items){
            $data[] = "$items->nik-$items->nama";
        }

        $detail_data_penerima = DB::table("detail_data_penerima")
            ->leftJoin("datapenerima", "datapenerima.nik", "=", "detail_data_penerima.nik")
            ->get();

        return view("Admin.kriteria.kondisi_ekonomi.index", compact("data", "detail_data_penerima"));
    }

    public function create_kriteria(Request $request){
        $request->validate([
            "nama" => "required",
            "kondisi_ekonomi" => "required",
            "taraf_kesejahteraan" => "required",
            "penderita_penyakit" => "required",
            "usia" => "required",
            "kepala_keluarga" => "required",
        ]);

        try {
            $input["nik"] = strtok($request->nama ,"-");
            $input["sub_ekonomi"] = $request->kondisi_ekonomi;
            if ($request->kondisi_ekonomi == "1"){
                $input["bobot_ekonomi"] = 50;
            }elseif ($request->kondisi_ekonomi == "2"){
                $input["bobot_ekonomi"] = 30;
            }elseif ($request->kondisi_ekonomi == "3"){
                $input["bobot_ekonomi"] = 20;
            }
            $input["sub_kesejahteraan"] = $request->taraf_kesejahteraan;
            if ($request->taraf_kesejahteraan == "1"){
                $input["bobot_kesejahteraan"] = 50;
            }elseif ($request->taraf_kesejahteraan == "2"){
                $input["bobot_kesejahteraan"] = 30;
            }elseif ($request->taraf_kesejahteraan == "3"){
                $input["bobot_kesejahteraan"] = 20;
            }
            $input["sub_penyakit"] = $request->penderita_penyakit;
            if ($request->penderita_penyakit == "1"){
                $input["bobot_penyakit"] = 30;
            }elseif ($request->penderita_penyakit == "2"){
                $input["bobot_penyakit"] = 70;
            }
            $input["sub_usia"] = $request->usia;
            if ($request->usia == "Dewasa"){
                $input["bobot_usia"] = 10;
            }elseif ($request->usia == "Lansia"){
                $input["bobot_usia"] = 35;
            }elseif ($request->usia == "Manula"){
                $input["bobot_usia"] = 55;
            }
            $input["sub_k_keluarga"] = $request->kepala_keluarga;
            if ($request->kepala_keluarga == "Mampu Bekerja"){
                $input["bobot_k_keluarga"] = 25;
            }elseif ($request->kepala_keluarga == "Tidak Mampu Bekerja"){
                $input["bobot_k_keluarga"] = 75;
            }

            DB::table("detail_data_penerima")->insert($input);
            return redirect(route("index_kriteria_admin"));
        }catch (\Exception $exception){
            return $exception;
            return redirect()->back();
        }
    }
}
