<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataPenerima;
//untuk manggil model DataPenerima
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//DB inisialisasi tabel

class C_DataPenerima extends Controller
{
    public function index(){
        $data_penerima = DB::table("datapenerima")
            ->get();
        return view ("Admin.Data_Penerima.index",compact("data_penerima"));
    //compact ngirim data dan ngambil variabel ke dalam data penerima
    }

    public function create_penerima(Request $request){
        //buat ngecek pas disubmit nama pengguna kosong buat handle
        $request->validate([
            //reques buat ambil data validate untuk validasi
            "nik"=>"required",
            "nama"=>"required",
            "alamat"=>"required",
            //nik,nama,alamat sesuai sama name di view nya
        ]);

        //errorhandler digunakan ketika user terjadi eror sistem tidak menampilkan eror
        //ngasih tau salahnya dimana
        try {
            $input["nik"] = $request->nik;
            $input["nama"] = $request->nama;
            $input["alamat"] = $request->alamat;

            DataPenerima::create($input);
            //membuat row baru di database data berdasarkan input
            return redirect(route("index_penerima_admin"));
        }catch (\Expection $exception){
            return redirect()->back()->withInput();
        }
        //handle error bisa dilakukan eksekusi atau nampilkan error nya
    }

    //Edit Penerima
    public function edit_penerima(Request $request, $id){
        //buat ngecek pas disubmit nama pengguna kosong buat handle
        //kenapa ada id nya karena butuh id request buat ngubah nya
        $request->validate([
            //reques buat ambil data validate untuk validasi
            "nik"=>"required",
            "nama"=>"required",
            "alamat"=>"required",
            //nik,nama,alamat sesuai sama name di view nya
        ]);

        $data_pengajuan = DB::table('datapenerima')
            ->where('id', $id)
            ->first();

        //errorhandler digunakan ketika user terjadi eror sistem tidak menampilkan eror
        //ngasih tau salahnya dimana
        try {
            $input["nik"] = $request->nik;
            $input["nama"] = $request->nama;
            $input["alamat"] = $request->alamat;

            $input_pengajuan['kode_penerima'] = $request->nik;

            DataPenerima::where("id",$id)->update($input);
            DB::table('status_pengajuan')
                ->where('kode_penerima', $data_pengajuan->nik)
                ->update($input_pengajuan);
            //membuat row baru di database data berdasarkan input
            return redirect(route("index_penerima_admin"));
        }catch (\Expection $exception){
            return redirect()->back();
        }
        //handle error bisa dilakukan eksekusi atau nampilkan error nya
    }

    //Delete Penerima
    public function delete_penerima($id){
        DataPenerima::where("id",$id)->delete();
        return redirect()->back();
    }

}
