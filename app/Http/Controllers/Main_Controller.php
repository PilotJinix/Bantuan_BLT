<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Main_Controller extends Controller
{
    public function index(){
        $s_periode = DB::table("data_periode")->where('status', '=', '1')->count();
        $s_pengguna = DB::table("users")->where("role", "!=", "Super Admin")->count();
        $s_c_penerima = DB::table("datapenerima")->count();

//        $data_periode = DB::table("data_periode")->get();
        return view("dashboard.index", compact("s_pengguna", "s_c_penerima", 's_periode'));
    }
}
