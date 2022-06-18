<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class C_SubKriteria extends Controller
{
    public function index($kode)
    {
        $data_kriteria = DB::table("master_kriteria")->where("kode_unik", $kode)->first();

        $data_sub_kriteria = DB::table('master_sub_kriteria')
            ->where('kode_unik_kriteria', $kode)
            ->orderBy("prioritas_sub", "ASC")
            ->get();

        $skala_sub_kriteria = DB::table("skala_sub_kriteria")
            ->select("skala_sub_kriteria.*", "master_sub_kriteria.nama_sub_kriteria")
            ->leftJoin("master_sub_kriteria", "master_sub_kriteria.kode_unik", "=", "skala_sub_kriteria.sub_kriteria_pembanding")
//            ->groupBy("skala_kriteria.kriteria_pembanding")
            ->get();

//        dd($skala_sub_kriteria);

        $master_inverse = DB::table("master_inverse_tfn")->get();

//        dd($skala_kriteria);

        $tfn = ["l_tfn", "f_tfn", "n_tfn"];
        $reciprocal = ["l_reciprocal", "f_reciprocal", "n_reciprocal"];
        $object_tfn = ["l", "f", "u"];

        $data_skala_sub_kriteria = [];
        $data_matrik_pairwaise_comparison = [];

//        dd($skala_kriteria);
        if (!is_null($skala_sub_kriteria)){
            foreach ($skala_sub_kriteria as $key => $items){
                $colom = new \stdClass();
                //Original
                $colom->kode_unik = $items->nama_sub_kriteria;
                //End

//                $colom->nama_kriteria = $items->nama_kriteria;
//                $colom->kode_unik = $items->kriteria_pembanding;
                if ($key == 0){
                    foreach ($skala_sub_kriteria as $key1 => $items1){
                        $colom->{$key1 + 1} = $items1->nilai_skala_sub;

                        $colom_matrik_pairwaise = new \stdClass();
                        for ($i=0; $i<3 ; $i++){
                            $colom_matrik_pairwaise->kriteria = $items1->nama_sub_kriteria;
                            $colom_matrik_pairwaise->kode_kriteria = $items1->sub_kriteria_pembanding;
                            $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$items1->nilai_skala_sub - 1]->{$tfn[$i]};
                        }
                        array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                    }
                }else{
                    foreach ($skala_sub_kriteria as $key2 => $items2){
                        $colom_matrik_pairwaise = new \stdClass();
                        if ($key <= $key2){
                            if ($key2 == $key){
                                $colom->{$key2 + 1} = "1.00";


                                for ($i=0; $i<3 ; $i++){
                                    $colom_matrik_pairwaise->kriteria = $items2->nama_sub_kriteria;
                                    $colom_matrik_pairwaise->kode_kriteria = $items2->sub_kriteria_pembanding;
                                    $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[0]->{$tfn[$i]};
                                }
                                array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                            }else{
//                                var_dump($key2, $key);
                                $colom->{$key2 + 1} = $skala_sub_kriteria[$key2-$key]->nilai_skala_sub;


                                for ($i=0; $i<3 ; $i++){
                                    $colom_matrik_pairwaise->kriteria = $items2->nama_sub_kriteria;
                                    $colom_matrik_pairwaise->kode_kriteria = $items2->sub_kriteria_pembanding;
                                    $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$skala_sub_kriteria[$key2-$key]->nilai_skala_sub-1]->{$tfn[$i]};
                                }
                                array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                            }
                        }else{
//                            dd($skala_kriteria[$key]);
                            $colom->{$key2 + 1} = $skala_sub_kriteria[0]->nilai_skala_sub." / ".$skala_sub_kriteria[$key-$key2]->nilai_skala_sub;


                            for ($i=0; $i<3 ; $i++){
                                $colom_matrik_pairwaise->kriteria = $items2->nama_sub_kriteria;
                                $colom_matrik_pairwaise->kode_kriteria = $items2->sub_kriteria_pembanding;
                                $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$skala_sub_kriteria[$key-$key2]->nilai_skala_sub-1]->{$reciprocal[$i]};
                            }
                            array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                        }

                    }
                }
                array_push($data_skala_sub_kriteria, $colom);
            }
        }

//        dd($data_skala_sub_kriteria);

        return view("Admin.Sub_Kriteria.index", compact("data_kriteria" ,"data_sub_kriteria", "data_skala_sub_kriteria"));
    }

    public function data_sub_kriteria(Request $request){
        if (!is_null($request->kode_kriteria)){
            $data = DB::table("master_sub_kriteria")
                ->where("kode_unik_kriteria", $request->kode_skala)
                ->where("kode_unik", "!=", $request->kode_kriteria)
                ->whereRaw("kode_unik NOT IN (select sub_kriteria_pembanding from skala_sub_kriteria where sub_kriteria_awal = '$request->kode_kriteria')")
                ->orderBy("prioritas_sub", "ASC")
                ->get();
            return $data;
        }
    }

    public function create_sub_kriteria(Request $request, $kode_unik){
        $request->validate([
            "nama_sub_kriteria" => "required",
            "nama_sub_kode" => "required",
            "prioritas_sub" => "required",
        ]);

        try {
            $input["kode_unik_kriteria"] = $kode_unik;
            $input["kode_unik"] = Uuid::uuid1()->toString();
            $input["nama_sub_kriteria"] = $request->nama_sub_kriteria;
            $input["kode_sub"] = $request->nama_sub_kode;
            $input["prioritas_sub"] = $request->prioritas_sub;
            $input["created_at"] = Carbon::now();
            $input["updated_at"] = Carbon::now();

            DB::table("master_sub_kriteria")->insert($input);
            return redirect(route("index_sub_kriteria", $kode_unik));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    // Skala Kriteria
    public function create_skala_sub_kriteria(Request $request, $kode){

        $data_sub_kriteria = DB::table("master_sub_kriteria")
            ->where("kode_unik_kriteria", $kode)
            ->orderBy("prioritas_sub", "ASC")
            ->get();


        $data_cek_skala_sub_kriteria = DB::table("skala_sub_kriteria")
            ->where("sub_kriteria_pembanding", $data_sub_kriteria[0]->kode_unik)
            ->first();

        $data_request = $request->toArray();
//        dd($data_request, $data_kriteria, $data_cek_skala_skriteria);

        try {
            $data_skala_sub_kriteria = [];
            $data_awal = true;
            $kriteria_awal="";
            foreach ($data_request as $key => $items){
                foreach ($data_sub_kriteria as $item_kriteria){
                    if ($data_awal == true and is_null($data_cek_skala_sub_kriteria)){
                        $document = new \stdClass();
                        $document->kode_unik = $item_kriteria->kode_unik;
                        $kriteria_awal = $item_kriteria->kode_unik;
                        $document->value = "1";
                        $data_awal = false;
                        array_push($data_skala_sub_kriteria, $document);
                    }else{
                        if ($key == $item_kriteria->kode_unik){
                            $document = new \stdClass();
                            $document->kode_unik = $item_kriteria->kode_unik;
                            $document->value = $items;
                            array_push($data_skala_sub_kriteria, $document);
                        }

                    }
                }
            }

//            dd($data_kriteria);

//            dd("f");
            foreach ($data_skala_sub_kriteria as $skala_sub_kriteria){
                $input["sub_kriteria_awal"] = $kriteria_awal != ""? $kriteria_awal : $data_sub_kriteria[0]->kode_unik ;
                $input["sub_kriteria_pembanding"] = $skala_sub_kriteria->kode_unik;
                $input["nilai_skala_sub"] = $skala_sub_kriteria->value;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();
                DB::table("skala_sub_kriteria")->insert($input);
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
