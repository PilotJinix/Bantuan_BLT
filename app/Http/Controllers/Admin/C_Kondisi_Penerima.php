<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Symfony\Component\VarDumper\Cloner\Data;
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

//        dd($data_kriteria['periode']);

        $data_kriteria['kriteria'] = DB::table('master_kriteria')
            ->where('kode_unik_skala', $data_kriteria['periode']->kode_unik_skala)
            ->get();

        $cek_kriteria = array_column($data_kriteria['kriteria']->toArray(), 'kode_unik');


        $data_kriteria['sub_kriteria'] = DB::table('master_sub_kriteria')
            ->whereIn('kode_unik_kriteria', $cek_kriteria)
            ->get();

        $kode_periode = $data_kriteria['periode']->kode_unik;

        $data_calon_penerima = DB::table('datapenerima')
            ->whereRaw("nik NOT IN (select kode_penerima from status_pengajuan where kode_unik_periode = '$kode_periode')")
            ->get();

//        dd($data_calon_penerima, $data_periode);

        $data_pengajuan = DB::table('status_pengajuan')
            ->select('status_pengajuan.*', 'datapenerima.nama', 'datapenerima.alamat', DB::raw('(CASE WHEN status_pengajuan.kode_unik = hasil_jawaban.kode_pengajuan THEN 1 ELSE 0 END) AS is_hasil'))
            ->leftJoin('datapenerima', 'datapenerima.nik', 'status_pengajuan.kode_penerima')
            ->leftJoin('data_periode', 'data_periode.kode_unik', 'status_pengajuan.kode_unik_periode')
            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
//            ->leftJoin('hasil_jawaban', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->distinct()
            ->get();

//        dd($data_pengajuan);

        $data_pengajuan_edit = DB::table('hasil_jawaban')
            ->select('hasil_jawaban.*', 'master_sub_kriteria.kode_unik_kriteria as kriteria')
            ->leftJoin('status_pengajuan', 'hasil_jawaban.kode_pengajuan', 'status_pengajuan.kode_unik')
            ->leftJoin('master_sub_kriteria', 'hasil_jawaban.kode_kriteria', 'master_sub_kriteria.kode_unik')
            ->where('status_pengajuan.kode_unik_periode', '=', $data_kriteria['periode']->kode_unik)
            ->distinct()
            ->get();
//        dd($data_kriteria['kriteria'],$data_pengajuan_edit, $data_kriteria['sub_kriteria']);
//        dd($data_pengajuan);
        return view('Admin.Informasi.detail', compact('data_pengajuan','data_calon_penerima', 'data_kriteria', 'data_pengajuan_edit'));
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
//        dd($request);
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

    public function ranking($id)
    {
        $cek_kriteria = DB::table("data_periode")
            ->select('master_kriteria.*',DB::raw('(CASE WHEN master_kriteria.kode_unik = master_sub_kriteria.kode_unik_kriteria THEN 1 ELSE 0 END) AS is_hasil'))
            ->leftJoin('master_skala', 'master_skala.kode_unik', 'data_periode.kode_unik_skala')
            ->leftJoin('master_kriteria', 'master_kriteria.kode_unik_skala', 'master_skala.kode_unik')
            ->leftJoin('master_sub_kriteria', 'master_sub_kriteria.kode_unik_kriteria', 'master_kriteria.kode_unik')
            ->where("data_periode.id", $id)
            ->distinct()
            ->get();

        $calon_penerima['penerima'] = DB::table('status_pengajuan')
            ->select('status_pengajuan.*', 'datapenerima.nik', 'datapenerima.nama')
            ->leftJoin('datapenerima', 'datapenerima.nik', 'status_pengajuan.kode_penerima')
            ->leftJoin('data_periode', 'data_periode.kode_unik', 'status_pengajuan.kode_unik_periode')
            ->where('data_periode.id', $id)
            ->get();

        foreach ($calon_penerima['penerima'] as $key => $items){
            $temp = DB::table('hasil_jawaban')
                ->where('kode_pengajuan', $items->kode_unik)
                ->get()->toArray();
            $calon_penerima['penerima'][$key]->hasil = $temp;
        }

        $data['kriteria'] = $this->index_kriteria($id);
        $data['sub_kriteria'] = [];
        foreach ($cek_kriteria as $items){
            if ($items->is_hasil == '1'){
                $temp = $this->index_sub_kriteria($items->kode_unik);
                array_push($data['sub_kriteria'], $temp);
            }
        }

//        dd($data, $calon_penerima);

        $total = [];

        foreach ($calon_penerima['penerima'] as $items1){
            $result = new \stdClass();
            $result->nama = $items1->nama;
            $result->nik = $items1->nik;
            $result->kode_status_pengajuan = $items1->kode_unik;
            $cek_jawaban = [];
            foreach ($items1->hasil as $items2){
                $jawaban = new \stdClass();
                foreach ($data['kriteria'] as $kriteria){
                    foreach ($data['sub_kriteria'] as $sub_kriteria){
                        foreach ($sub_kriteria as $data_sub){
                            if ($data_sub->master_kriteria == $kriteria->kode_kriteria and $data_sub->kode_sub_kriteria == $items2->kode_kriteria){
                                $jawaban->kriteria = $kriteria->kode_kriteria;
                                $jawaban->jawaban = $items2->kode_kriteria;
                                $jawaban->total = $data_sub->bobot * $data_sub->result * $kriteria->result;
                                array_push($cek_jawaban, $jawaban);
                            }
                        }
                    }
                }
            }
            $result->data_mentah = $cek_jawaban;
            $result->total = array_sum(array_column($cek_jawaban, 'total'));
            array_push($total, $result);
        }
        $final = DataTables::of(collect($total)->sortByDesc('total'))
            ->make(true);

        return $final;
    }

    //  Perhitungan

    public function format_number($value, $digit){
        $data = number_format($value, $digit, '.', '');
        return (float)$data;
    }

    public function index_kriteria($id){

        $data_cek = DB::table("data_periode")
            ->where("id", $id)
            ->first();

//        dd($data_cek);

//        $data_skala = DB::table("master_skala")->where("kode_unik", $data_cek->kode_unik_skala)->first();

        $data_kriteria = DB::table("master_kriteria")
            ->where("kode_unik_skala", $data_cek->kode_unik_skala)
            ->orderBy("prioritas", "ASC")
            ->get();

        $skala_kriteria = DB::table("skala_kriteria")
            ->select("skala_kriteria.*", "master_kriteria.nama_kriteria")
            ->leftJoin("master_kriteria", "master_kriteria.kode_unik", "=", "skala_kriteria.kriteria_pembanding")
            ->whereraw("kriteria_awal in (select kode_unik from master_kriteria where kode_unik_skala = '{$data_cek->kode_unik_skala}')" )
            ->orderBy('master_kriteria.prioritas', 'ASC')
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

        $perhitungan = collect($this->perhitungan($data_matrik_pairwaise_comparison, $data_kriteria));

        return $perhitungan;
    }

    public function index_sub_kriteria($kode)
    {

        $data_sub_kriteria = DB::table('master_sub_kriteria')
            ->where('kode_unik_kriteria', $kode)
            ->orderBy("prioritas_sub", "ASC")
            ->get();

        $skala_sub_kriteria = DB::table("skala_sub_kriteria")
            ->select("skala_sub_kriteria.*", "master_sub_kriteria.nama_sub_kriteria", 'master_sub_kriteria.bobot', 'master_kriteria.kode_unik')
            ->leftJoin("master_sub_kriteria", "master_sub_kriteria.kode_unik", "=", "skala_sub_kriteria.sub_kriteria_pembanding")
            ->leftJoin("master_kriteria", "master_kriteria.kode_unik", "=", "master_sub_kriteria.kode_unik_kriteria")
            ->whereraw("sub_kriteria_awal in (select kode_unik from master_sub_kriteria where kode_unik_kriteria = '{$kode}')" )
            ->orderBy('master_sub_kriteria.prioritas_sub', 'ASC')
//            ->groupBy("skala_kriteria.kriteria_pembanding")
            ->get();

//        dd($skala_sub_kriteria, 'c');

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
                $colom->bobot = $items->bobot;
                $colom->master_kriteria = $items->kode_unik;
                //End

//                $colom->nama_kriteria = $items->nama_kriteria;
//                $colom->kode_unik = $items->kriteria_pembanding;
                if ($key == 0){
                    foreach ($skala_sub_kriteria as $key1 => $items1){
                        $colom->{$key1 + 1} = $items1->nilai_skala_sub;

                        $colom_matrik_pairwaise = new \stdClass();
                        for ($i=0; $i<3 ; $i++){
                            $colom_matrik_pairwaise->kriteria = $items1->nama_sub_kriteria;
                            $colom_matrik_pairwaise->bobot = $items1->bobot;
                            $colom_matrik_pairwaise->master_kriteria = $items1->kode_unik;
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
                                    $colom_matrik_pairwaise->bobot = $items2->bobot;
                                    $colom_matrik_pairwaise->master_kriteria = $items2->kode_unik;
                                    $colom_matrik_pairwaise->kode_kriteria = $items2->sub_kriteria_pembanding;
                                    $colom_matrik_pairwaise->{$object_tfn[$i]} = $master_inverse[0]->{$tfn[$i]};
                                }
                                array_push($data_matrik_pairwaise_comparison, $colom_matrik_pairwaise);
                            }else{
//                                var_dump($key2, $key);
                                $colom->{$key2 + 1} = $skala_sub_kriteria[$key2-$key]->nilai_skala_sub;


                                for ($i=0; $i<3 ; $i++){
                                    $colom_matrik_pairwaise->kriteria = $items2->nama_sub_kriteria;
                                    $colom_matrik_pairwaise->bobot = $items2->bobot;
                                    $colom_matrik_pairwaise->master_kriteria = $items2->kode_unik;
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
                                $colom_matrik_pairwaise->bobot = $items2->bobot;
                                $colom_matrik_pairwaise->master_kriteria = $items2->kode_unik;
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
        $perhitungan = collect($this->perhitungan_sub_kriteria($data_matrik_pairwaise_comparison, $data_sub_kriteria));


        return $perhitungan;
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

        $total_l_1 = 1 / $total_u;
        $total_m_1 = 1 / $total_m;
        $total_u_1 = 1 / $total_l;

        $sintetis_matrix = [];

        foreach ($fuzzy_triangular_number as $ftn){
            $sintetis = new \stdClass();
            $sintetis->kriteria = $ftn->kriteria;
            $sintetis->kode_kriteria = $ftn->kode_kriteria;
            $sintetis->jumlah_l = $ftn->l * $total_l_1;
            $sintetis->jumlah_m = $ftn->m * $total_m_1;
            $sintetis->jumlah_u = $ftn->u * $total_u_1;
//            dd($fuzzy_triangular_number, $ftn->u, $total_u_1);
            array_push($sintetis_matrix, $sintetis);
        }

        $DEFUZZIFIKASI =[];
        $Nilai_Bobot_Fuzzy = [];

        foreach ($sintetis_matrix as $key => $def){
            $temp_bobot_fuzzy = new \stdClass();
            $temp = [];

            foreach ($sintetis_matrix as $def2){
                $temp_def = new \stdClass();
                $temp_def->nama_kriteria = $def->kriteria;
                $temp_def->kode_kriteria = $def->kode_kriteria;
                if ($key == 0){
                    if ($def->kode_kriteria != $def2->kode_kriteria){
                        $temp_def->nama_kriteria_pembanding = $def2->kriteria;
                        $temp_def->kode_kriteria_pembanding = $def2->kode_kriteria;
                        $temp_def->nilai_acuan = 1;
                        array_push($temp, $temp_def);
                    }
                }else{


                    if ($def->kode_kriteria != $def2->kode_kriteria){
                        $temp_def->nama_kriteria_pembanding = $def2->kriteria;
                        $temp_def->kode_kriteria_pembanding = $def2->kode_kriteria;
                        if ($def->jumlah_m >= $def2->jumlah_m){
                            $temp_def->nilai_acuan = 1;
                        }elseif ($def2->jumlah_l >= $def->jumlah_u){
                            $temp_def->nilai_acuan = 0;
                        }else{

                            $q = $this->format_number($def2->jumlah_l - $def->jumlah_u, 5);
//                            dd($sintetis_matrix,$q, $this->format_number($def2->jumlah_l-$def->jumlah_u, 6));

                            $w = $this->format_number($def->jumlah_m - $def->jumlah_u, 5);
                            $e = $this->format_number($def2->jumlah_m - $def2->jumlah_l, 5);
                            $r = $w - $e;
                            $t = $this->format_number($q / $r, 4);

//                            dd($q, $w, $e,$r,$t);

//                            dd($sintetis_matrix, $def2->jumlah_l, $def->jumlah_u, $def->jumlah_m, $def->jumlah_u, $def2->jumlah_m, $def2->jumlah_l);
                            $temp_def->nilai_acuan = $this->format_number($t, 4);
                        }
//                        dd($sintetis_matrix, $def->jumlah_m. " >= " .$def2->jumlah_m,  $def2->jumlah_l." >= ".$def->jumlah_u, $temp_def);
                        array_push($temp, $temp_def);
                    }
                }
            }
            $open_temp = array_column($temp, 'nilai_acuan');
            array_push($temp, min($open_temp));

            $temp_bobot_fuzzy->nama_kriteria = $def->kriteria;
            $temp_bobot_fuzzy->kode_kriteria = $def->kode_kriteria;
            $temp_bobot_fuzzy->min_result = min($open_temp);


            array_push($Nilai_Bobot_Fuzzy, $temp_bobot_fuzzy);
            array_push($DEFUZZIFIKASI,$temp);
        }

        $sum = array_sum(array_column($Nilai_Bobot_Fuzzy,'min_result'));

        $normalisasi_bobot = [];
        foreach ($Nilai_Bobot_Fuzzy as $item_bobot_fuzzy){
            $temp_normalisasi_bobot = new \stdClass();

            $temp_normalisasi_bobot->nama_kriteria = $item_bobot_fuzzy->nama_kriteria;
            $temp_normalisasi_bobot->kode_kriteria = $item_bobot_fuzzy->kode_kriteria;
            $temp_normalisasi_bobot->result = $item_bobot_fuzzy->min_result/ $sum;

            array_push($normalisasi_bobot, $temp_normalisasi_bobot);
        }


//        dd($distribution_matrik, $fuzzy_triangular_number, $sintetis_matrix,$DEFUZZIFIKASI, $Nilai_Bobot_Fuzzy, $normalisasi_bobot);

        // END Method Perhitungan

        return $normalisasi_bobot;
//        return response()->json([
//            "FTN" => $fuzzy_triangular_number,
//            "total_l" => $total_l_1,
//            "total_m" => $total_m_1,
//            "total_u" => $total_u_1,
//            "sintetis_matrix" => $sintetis_matrix
//        ]);

//        return [$fuzzy_triangular_number, $total_l_1, $total_m_1, $total_u_1, $sintetis_matrix];
    }

    public function perhitungan_sub_kriteria($i, $j){
//        dd($i,$j);
//        $distribution_matrik = array_chunk($data_matrik_pairwaise_comparison, count($data_kriteria));
        $distribution_matrik = array_chunk($i, count($j));

//        dd($distribution_matrik);

        $fuzzy_triangular_number = [];
//        dd($distribution_matrik);


        foreach ($distribution_matrik as $distribution => $matrix){
//            dd($matrix);
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
            $j->bobot = $matrix[$distribution]->bobot;
            $j->master_kriteria = $matrix[$distribution]->master_kriteria;
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

        $total_l_1 = 1 / $total_u;
        $total_m_1 = 1 / $total_m;
        $total_u_1 = 1 / $total_l;

        $sintetis_matrix = [];

        foreach ($fuzzy_triangular_number as $ftn){
            $sintetis = new \stdClass();
            $sintetis->kriteria = $ftn->kriteria;
            $sintetis->bobot = $ftn->bobot;
            $sintetis->master_kriteria = $ftn->master_kriteria;
            $sintetis->kode_kriteria = $ftn->kode_kriteria;
            $sintetis->jumlah_l = $ftn->l * $total_l_1;
            $sintetis->jumlah_m = $ftn->m * $total_m_1;
            $sintetis->jumlah_u = $ftn->u * $total_u_1;
//            dd($fuzzy_triangular_number, $ftn->u, $total_u_1);
            array_push($sintetis_matrix, $sintetis);
        }

        $DEFUZZIFIKASI =[];
        $Nilai_Bobot_Fuzzy = [];
//        dd($sintetis_matrix);

        foreach ($sintetis_matrix as $key => $def){
            $temp_bobot_fuzzy = new \stdClass();
            $temp = [];

            foreach ($sintetis_matrix as $def2){
                $temp_def = new \stdClass();
                $temp_def->nama_kriteria = $def->kriteria;
                $temp_def->bobot = $def->bobot;
                $temp_def->master_kriteria = $def->master_kriteria;
                $temp_def->kode_kriteria = $def->kode_kriteria;
                if ($key == 0){
                    if ($def->kode_kriteria != $def2->kode_kriteria){
                        $temp_def->nama_kriteria_pembanding = $def2->kriteria;
                        $temp_def->kode_kriteria_pembanding = $def2->kode_kriteria;
                        $temp_def->nilai_acuan = 1;
                        array_push($temp, $temp_def);
                    }
                }else{
                    if ($def->kode_kriteria != $def2->kode_kriteria){
                        $temp_def->nama_kriteria_pembanding = $def2->kriteria;
                        $temp_def->kode_kriteria_pembanding = $def2->kode_kriteria;
                        if ($def->jumlah_m >= $def2->jumlah_m){
                            $temp_def->nilai_acuan = 1;
                        }elseif ($def2->jumlah_l >= $def->jumlah_u){
                            $temp_def->nilai_acuan = 0;
                        }else{

                            $q = $this->format_number($def2->jumlah_l - $def->jumlah_u, 5);
//                            dd($sintetis_matrix,$q, $this->format_number($def2->jumlah_l-$def->jumlah_u, 6));

                            $w = $this->format_number($def->jumlah_m - $def->jumlah_u, 5);
                            $e = $this->format_number($def2->jumlah_m - $def2->jumlah_l, 5);
                            $r = $w - $e;
                            $t = $this->format_number($q / $r, 4);

//                            dd($q, $w, $e,$r,$t);

//                            dd($sintetis_matrix, $def2->jumlah_l, $def->jumlah_u, $def->jumlah_m, $def->jumlah_u, $def2->jumlah_m, $def2->jumlah_l);
                            $temp_def->nilai_acuan = $this->format_number($t, 4);
                        }
//                        dd($sintetis_matrix, $def->jumlah_m. " >= " .$def2->jumlah_m,  $def2->jumlah_l." >= ".$def->jumlah_u, $temp_def);
                        array_push($temp, $temp_def);
                    }
                }
            }
            $open_temp = array_column($temp, 'nilai_acuan');
            array_push($temp, min($open_temp));

            $temp_bobot_fuzzy->nama_kriteria = $def->kriteria;
            $temp_bobot_fuzzy->bobot = $def->bobot;
            $temp_bobot_fuzzy->master_kriteria = $def->master_kriteria;
            $temp_bobot_fuzzy->kode_kriteria = $def->kode_kriteria;
            $temp_bobot_fuzzy->min_result = min($open_temp);


            array_push($Nilai_Bobot_Fuzzy, $temp_bobot_fuzzy);
            array_push($DEFUZZIFIKASI,$temp);
        }

        $sum = array_sum(array_column($Nilai_Bobot_Fuzzy,'min_result'));

        $normalisasi_bobot = [];
        foreach ($Nilai_Bobot_Fuzzy as $item_bobot_fuzzy){
            $temp_normalisasi_bobot = new \stdClass();

            $temp_normalisasi_bobot->nama_kriteria = $item_bobot_fuzzy->nama_kriteria;
            $temp_normalisasi_bobot->bobot = $item_bobot_fuzzy->bobot;
            $temp_normalisasi_bobot->master_kriteria = $item_bobot_fuzzy->master_kriteria;
            $temp_normalisasi_bobot->kode_sub_kriteria = $item_bobot_fuzzy->kode_kriteria;
            $temp_normalisasi_bobot->result = $item_bobot_fuzzy->min_result/ $sum;

            array_push($normalisasi_bobot, $temp_normalisasi_bobot);
        }


//        dd($distribution_matrik, $fuzzy_triangular_number, $sintetis_matrix,$DEFUZZIFIKASI, $Nilai_Bobot_Fuzzy, $normalisasi_bobot);

        // END Method Perhitungan


        return $normalisasi_bobot;
//        return response()->json([
//            "FTN" => $fuzzy_triangular_number,
//            "total_l" => $total_l_1,
//            "total_m" => $total_m_1,
//            "total_u" => $total_u_1,
//            "sintetis_matrix" => $sintetis_matrix
//        ]);

//        return [$fuzzy_triangular_number, $total_l_1, $total_m_1, $total_u_1, $sintetis_matrix];
    }





}
