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

            $cek_master = DB::table("master_skala")
                ->leftJoin("master_kriteria", "master_kriteria.kode_unik_skala", "=", "master_skala.kode_unik")

                ->where([
                    "master_skala.id" => $id,
                    "master_kriteria.prioritas" => '1'
                ])->first();

//            dd($cek_master);
            DB::table("master_skala")->where("id", $id)->delete();
            DB::table("master_kriteria")->where("kode_unik_skala", $cek_master->kode_unik_skala)->delete();
            DB::table("skala_kriteria")->where("kriteria_awal", $cek_master->kode_unik)->delete();
            return redirect(route("index_skala"));
        }catch (\Exception $exception){
            return $exception;
        }
    }

    //  Kriteria

    public function index_kriteria(Request $request,$kode_skala){
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

        $master_inverse = DB::table("master_inverse_tfn")->get();

//        dd($skala_kriteria);

        $tfn = ["l_tfn", "f_tfn", "n_tfn"];
        $reciprocal = ["l_reciprocal", "f_reciprocal", "n_reciprocal"];
        $object_tfn = ["l", "f", "u"];

        $data_skala_kriteria = [];
        $data_matrik_pairwaise_comparison = [];

//        dd($skala_kriteria);
        if (!is_null($skala_kriteria)){
            foreach ($skala_kriteria as $key => $items){
                $colom = new \stdClass();
                //Original
                $colom->kode_unik = $items->nama_kriteria;
                //End

//                $colom->nama_kriteria = $items->nama_kriteria;
//                $colom->kode_unik = $items->kriteria_pembanding;
                if ($key == 0){
                    foreach ($skala_kriteria as $key1 => $items1){
                        $colom->{$key1 + 1} = $items1->nilai_skala;

                        $colom_matrik_pairwaise = new \stdClass();
                        for ($i=0; $i<3 ; $i++){
                            $colom_matrik_pairwaise->kriteria = $items1->nama_kriteria;
                            $colom_matrik_pairwaise->kode_kriteria = $items1->kriteria_pembanding;
                            $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$items1->nilai_skala - 1]->{$tfn[$i]};
                        }
                        array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                    }
                }else{
                    foreach ($skala_kriteria as $key2 => $items2){
                        $colom_matrik_pairwaise = new \stdClass();
                        if ($key <= $key2){
                            if ($key2 == $key){
                                $colom->{$key2 + 1} = "1.00";


                                for ($i=0; $i<3 ; $i++){
                                    $colom_matrik_pairwaise->kriteria = $items2->nama_kriteria;
                                    $colom_matrik_pairwaise->kode_kriteria = $items2->kriteria_pembanding;
                                    $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[0]->{$tfn[$i]};
                                }
                                array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                            }else{
//                                var_dump($key2, $key);
                                $colom->{$key2 + 1} = $skala_kriteria[$key2-$key]->nilai_skala;


                                for ($i=0; $i<3 ; $i++){
                                    $colom_matrik_pairwaise->kriteria = $items2->nama_kriteria;
                                    $colom_matrik_pairwaise->kode_kriteria = $items2->kriteria_pembanding;
                                    $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$skala_kriteria[$key2-$key]->nilai_skala-1]->{$tfn[$i]};
                                }
                                array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                            }
                        }else{
//                            dd($skala_kriteria[$key]);
                            $colom->{$key2 + 1} = $skala_kriteria[0]->nilai_skala." / ".$skala_kriteria[$key-$key2]->nilai_skala;


                            for ($i=0; $i<3 ; $i++){
                                $colom_matrik_pairwaise->kriteria = $items2->nama_kriteria;
                                $colom_matrik_pairwaise->kode_kriteria = $items2->kriteria_pembanding;
                                $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[$skala_kriteria[$key-$key2]->nilai_skala-1]->{$reciprocal[$i]};
                            }
                            array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                        }

                    }
                }
                array_push($data_skala_kriteria, $colom);
            }
        }



//        // Method Perhitungan
//        $distribution_matrik = array_chunk($data_matrik_pairwaise_comparison, count($data_kriteria));
//        $fuzzy_triangular_number = [];
//
//
//        foreach ($distribution_matrik as $distribution => $matrix){
//            $l = 0;
//            $f = 0;
//            $u = 0;
//            $j = new \stdClass();
//            foreach ($matrix as $matrix2){
//                $l += $matrix2->l;
//                $f += $matrix2->f;
//                $u += $matrix2->u;
//            }
//            $j->kriteria = $matrix[$distribution]->kriteria;
//            $j->kode_kriteria = $matrix[$distribution]->kode_kriteria;
//            $j->l = $l;
//            $j->m = $f;
//            $j->u = $u;
//            array_push($fuzzy_triangular_number, $j);
//        }
//
//        $total_l = 0;
//        $total_m = 0;
//        $total_u = 0;
//        foreach ($fuzzy_triangular_number as $r =>  $fuzzy){
//            $total_l += $fuzzy->l;
//            $total_m += $fuzzy->m;
//            $total_u += $fuzzy->u;
//        }
//
//        $total_l_1 = 1 / $total_l;
//        $total_m_1 = 1 / $total_m;
//        $total_u_1 = 1 / $total_u;
//
//        $sintetis_matrix = [];
//        foreach ($fuzzy_triangular_number as $ftn){
//            $sintetis = new \stdClass();
//            $sintetis->kriteria = $ftn->kriteria;
//            $sintetis->kode_kriteria = $ftn->kode_kriteria;
//            $sintetis->jumlah_l = $ftn->u * $total_u_1;
//            $sintetis->jumlah_m = $ftn->m * $total_m_1;
//            $sintetis->jumlah_u = $ftn->l * $total_l_1;
//            array_push($sintetis_matrix, $sintetis);
//        }
//
//        dd($distribution_matrik, $fuzzy_triangular_number, $sintetis_matrix);
//
//        // END Method Perhitungan





        if ($request->ajax()){
            $perhitungan = $this->perhitungan($data_matrik_pairwaise_comparison, $data_kriteria);

            return $perhitungan;
        }



//
//        dd($perhitungan);

//        dd($data_kriteria, $skala_kriteria, $data_skala_kriteria, $data_matrik_pairwaise_comparison);

        return view("Test.skala.detail", compact("data_skala", "data_kriteria", "data_skala_kriteria"));

    }

    public function perhitungan($i, $j){
//        $distribution_matrik = array_chunk($data_matrik_pairwaise_comparison, count($data_kriteria));
        $distribution_matrik = array_chunk($i, count($j));
        $fuzzy_triangular_number = [];


        foreach ($distribution_matrik as $distribution => $matrix){
            $l = 0;
            $f = 0;
            $u = 0;
            $j = new \stdClass();
            foreach ($matrix as $matrix2){
                $l += $matrix2->l;
                $f += $matrix2->f;
                $u += $matrix2->u;
            }
            $j->kriteria = $matrix[$distribution]->kriteria;
            $j->kode_kriteria = $matrix[$distribution]->kode_kriteria;
            $j->l = $l;
            $j->m = $f;
            $j->u = $u;
            array_push($fuzzy_triangular_number, $j);
        }

        $total_l = 0;
        $total_m = 0;
        $total_u = 0;
        foreach ($fuzzy_triangular_number as $r =>  $fuzzy){
            $total_l += $fuzzy->l;
            $total_m += $fuzzy->m;
            $total_u += $fuzzy->u;
        }

        $total_l_1 = 1 / $total_l;
        $total_m_1 = 1 / $total_m;
        $total_u_1 = 1 / $total_u;

        $sintetis_matrix = [];
        foreach ($fuzzy_triangular_number as $ftn){
            $sintetis = new \stdClass();
            $sintetis->kriteria = $ftn->kriteria;
            $sintetis->kode_kriteria = $ftn->kode_kriteria;
            $sintetis->jumlah_l = $ftn->u * $total_u_1;
            $sintetis->jumlah_m = $ftn->m * $total_m_1;
            $sintetis->jumlah_u = $ftn->l * $total_l_1;
            array_push($sintetis_matrix, $sintetis);
        }
        return response()->json([
            "FTN" => $fuzzy_triangular_number,
            "total_l" => $total_l_1,
            "total_m" => $total_m_1,
            "total_u" => $total_u_1,
            "sintetis_matrix" => $sintetis_matrix
        ]);

//        return [$fuzzy_triangular_number, $total_l_1, $total_m_1, $total_u_1, $sintetis_matrix];
    }

    public function data_kriteria(Request $request){
        if (!is_null($request->kode_kriteria)){
            $data = DB::table("master_kriteria")
                ->where("kode_unik_skala", $request->kode_skala)
                ->where("kode_unik", "!=", $request->kode_kriteria)
                ->whereRaw("kode_unik NOT IN (select kriteria_pembanding from skala_kriteria where kriteria_awal = '$request->kode_kriteria')")
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
            $skala_kritia = DB::table("master_kriteria")->where("id", $id)->first();
            DB::table("master_kriteria")->where("id", $id)->delete();
            DB::table("skala_kriteria")->where("kriteria_pembanding", $skala_kritia->kode_unik)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            return $exception;
        }
    }

    // Skala Kriteria
    public function create_skala_kriteria(Request $request, $kode){

        $data_kriteria = DB::table("master_kriteria")
            ->where("kode_unik_skala", $kode)
            ->orderBy("prioritas", "ASC")
            ->get();

        $data_cek_skala_skriteria = DB::table("skala_kriteria")
            ->where("kriteria_pembanding", $data_kriteria[0]->kode_unik)
            ->first();

        $data_request = $request->toArray();
//        dd($data_request, $data_kriteria, $data_cek_skala_skriteria);

        try {
            $data_skala_kriteria = [];
            $data_awal = true;
            $kriteria_awal="";
            foreach ($data_request as $key => $items){
                foreach ($data_kriteria as $item_kriteria){
                    if ($data_awal == true and is_null($data_cek_skala_skriteria)){
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

//            dd($data_kriteria);

//            dd("f");
            foreach ($data_skala_kriteria as $skala_kriteria){
                $input["kriteria_awal"] = $kriteria_awal != ""? $kriteria_awal : $data_kriteria[0]->kode_unik ;
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
