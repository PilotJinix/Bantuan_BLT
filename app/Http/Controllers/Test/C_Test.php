<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
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

        $data_kriteria = DB::table("master_kriteria")
            ->where("kode_unik_skala", $kode_skala)
            ->orderBy("prioritas", "ASC")
            ->get();

        $skala_kriteria = DB::table("skala_kriteria")
            ->select("skala_kriteria.*", "master_kriteria.nama_kriteria")
            ->leftJoin("master_kriteria", "master_kriteria.kode_unik", "=", "skala_kriteria.kriteria_pembanding")
//            ->groupBy("skala_kriteria.kriteria_pembanding")
            ->get();

        $data_skala_kriteria = [];

        if (!is_null($skala_kriteria)){
            foreach ($skala_kriteria as $key => $items){

                $colom = new \stdClass();
                $colom->kode_unik = $items->nama_kriteria;
                if ($key == 0){
                    foreach ($skala_kriteria as $key1 => $items1){
                        $colom->{$key1 + 1} = $items1->nilai_skala;
                    }
                }else{
                    foreach ($skala_kriteria as $key2 => $items2){

                        if ($key <= $key2){

                            if ($key2 == $key){
                                $colom->{$key2 + 1} = "1.00";
                            }else{
                                var_dump($key2, $key);
                                $colom->{$key2 + 1} = $skala_kriteria[$key2-$key]->nilai_skala;
                            }
                        }else{

                            $colom->{$key2 + 1} = $skala_kriteria[0]->nilai_skala." / ".$skala_kriteria[$key2+1]->nilai_skala;
                        }

                    }
                }
                array_push($data_skala_kriteria, $colom);
            }
        }

//        dd($data_kriteria, $skala_kriteria, $data_skala_kriteria);

        return view("Test.skala.detail", compact("data_skala", "data_kriteria", "data_skala_kriteria"));

    }

    public function data_kriteria(Request $request){
        if (!is_null($request->kode_kriteria)){
            $data = DB::table("master_kriteria")
                ->where("kode_unik_skala", $request->kode_skala)
                ->where("kode_unik", "!=", $request->kode_kriteria)
                ->orderBy("prioritas", "ASC")
                ->get();
            return $data;
        }
    }

    public function create_kriteria(Request $request, $kode_skala){
        $request->validate([
            "nama_kriteria" => "required",
            "nama_kode" => "required",
            "prioritas" => "required",
        ]);

        try {
            $input["kode_unik_skala"] = $kode_skala;
            $input["kode_unik"] = Uuid::uuid1()->toString();
            $input["nama_kriteria"] = $request->nama_kriteria;
            $input["kode"] = $request->nama_kode;
            $input["prioritas"] = $request->prioritas;
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
            dd($id);
            DB::table("master_kriteria")->where("id", $id)->delete();
            DB::table("skala_kriteria")->where("kriteria_pembanding", $id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
        }
    }

    // Skala Kriteria
    public function create_skala_kriteria(Request $request, $kode){

        $data_kriteria = DB::table("master_kriteria")
            ->where("kode_unik_skala", $kode)
            ->get();

        $data_request = $request->toArray();

        try {
////            dd();
//            $validate = true;
//
//            foreach ($data_request as $key => $items){
//                if ($key != "_token"){
//                    $cek = 0;
//                    foreach ($data_request as $key1 => $items1){
//                        if ($key1 != "_token"){
//                            if ($cek <= 1){
//                                if ($items == $items1){
//                                    $cek += 1;
//
//                                }
//                                else{
//                                    $validate = false;
//                                }
//                            }
//                        }
//
//                    }
//
//                }
//            }
////            dd($validate);
//            if ($validate == false){
//                var_dump("false");
////                dd('S');
//                return false;
//            }


            $data_skala_kriteria = [];
            $data_awal = true;
            $kriteria_awal="";
            foreach ($data_request as $key => $items){
                foreach ($data_kriteria as $item_kriteria){
                    if ($data_awal == true){
                        $document = new \stdClass();
                        $document->kode_unik = $item_kriteria->kode_unik;
                        $kriteria_awal = $item_kriteria->kode_unik;
                        $document->value = "1";
                        $data_awal = false;
                        array_push($data_skala_kriteria, $document);
                    }else{
                        if ($key == $item_kriteria->kode_unik){
                            $document = new \stdClass();
                            $document->kode_unik = $item_kriteria->kode_unik;
                            $document->value = $items;
                            array_push($data_skala_kriteria, $document);
                        }

                    }
                }
            }

//            dd("f");
            foreach ($data_skala_kriteria as $skala_kriteria){
                $input["kriteria_awal"] = $kriteria_awal;
                $input["kriteria_pembanding"] = $skala_kriteria->kode_unik;
                $input["nilai_skala"] = $skala_kriteria->value;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();
                DB::table("skala_kriteria")->insert($input);
            }
            return redirect()->back();
//            dd($data_kriteria, $data_request, $data_skala_kriteria);

        }catch (\Exception $exception){
//            return $exception;
            return redirect()->back();
        }
//        dd($data_skala_kriteria);
    }
}
