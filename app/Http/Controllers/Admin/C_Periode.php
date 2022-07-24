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
    public function create_periode(Request $request){

        if (auth()->user()->role == 'Super Admin'){
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
                $input["periode"] = date_format(date_create($request->period), 'Y-m-d H:i:s');
                $input["kuota"] = $request->kuota;
                $input["status"] = $request->status;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();

                DB::table("data_periode")->insert($input);
                return response()->json(array("status" => 'good', "msg" => ""));
            }catch (\Exception $exception){
//                dd($exception);
                return response()->json(array("status" => 'Galat', "msg" => ""));
            }

        }elseif (auth()->user()->role == 'Kadus'){
            $request->validate([
                "versi" => "required",
                "nama_periode" => "required",
                "period" => "required",
                "kuota" => "required",
//                "status" => "required",
            ]);

            try {
                $input['kode_unik_skala'] = $request->versi;
                $input["kode_unik"] = Uuid::uuid1()->toString();
                $input["nama"] = $request->nama_periode;
                $input["periode"] = date_format(date_create($request->period), 'Y-m-d H:i:s');
                $input["kuota"] = $request->kuota;
                $input["status"] = '0';
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();

                DB::table("data_periode")->insert($input);
                return response()->json(array("status" => 'good', "msg" => ""));
            }catch (\Exception $exception){
                return response()->json(array("status" => 'Galat', "msg" => ""));
            }

        }
//        return redirect()->back();
    }

    public function edit_periode(Request $request, $id){
        if (auth()->user()->role == 'Super Admin'){
            $request->validate([
                "edit_nama_periode" => "required",
                "edit_period" => "required",
                "edit_kuota" => "required",
                "edit_status" => "required",
            ]);

//        dd($request->id);
            try {
                $input["nama"] = $request->edit_nama_periode;
                $input["periode"] = date_format(date_create($request->edit_period), 'Y-m-d H:i:s');
                $input["kuota"] = $request->edit_kuota;
                $input["status"] = $request->edit_status;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();

                DB::table("data_periode")->where('id', $id)->update($input);
                return redirect()->back();
            }catch (\Exception $exception){
//            return $exception;
                return response()->json(array("status" => 'Galat', "msg" => ""));
            }
        }elseif (auth()->user()->role == 'Kades'){
            $request->validate([
//                "edit_nama_periode" => "required",
//                "edit_period" => "required",
//                "edit_kuota" => "required",
                "edit_status" => "required",
            ]);

//        dd($request->id);
            try {
//                $input["nama"] = $request->edit_nama_periode;
//                $input["periode"] = date_format(date_create($request->edit_period), 'Y-m-d H:i:s');
//                $input["kuota"] = $request->edit_kuota;
                $input["status"] = $request->edit_status;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();

                DB::table("data_periode")->where('id', $id)->update($input);
                return redirect()->back();
            }catch (\Exception $exception){
//            return $exception;
                return response()->json(array("status" => 'Galat', "msg" => ""));
            }
        }elseif (auth()->user()->role == 'Kadus'){
            $request->validate([
                "edit_nama_periode" => "required",
                "edit_period" => "required",
                "edit_kuota" => "required",
//                "edit_status" => "required",
            ]);

//        dd($request->id);
            try {
                $input["nama"] = $request->edit_nama_periode;
                $input["periode"] = date_format(date_create($request->edit_period), 'Y-m-d H:i:s');
                $input["kuota"] = $request->edit_kuota;
//                $input["status"] = $request->edit_status;
                $input["created_at"] = Carbon::now();
                $input["updated_at"] = Carbon::now();

                DB::table("data_periode")->where('id', $id)->update($input);
                return redirect()->back();
            }catch (\Exception $exception){
//            return $exception;
                return response()->json(array("status" => 'Galat', "msg" => ""));
            }
        }
    }

    public function delete_periode($id){
        try {
            DB::table("data_periode")->where("id", $id)->delete();
            return redirect()->back();
        }catch (\Exception $exception){
            return redirect()->back();
        }
    }
}
