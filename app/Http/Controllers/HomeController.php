<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()){
            $s_periode = DB::table("data_periode")->where('status', '=', '1')->count();
            $s_pengguna = DB::table("users")->where("role", "!=", "Super Admin")->count();
            $s_c_penerima = DB::table("datapenerima")->count();

//        $data_periode = DB::table("data_periode")->get();
            return view("dashboard.index", compact("s_pengguna", "s_c_penerima", 's_periode'));
        }else{
            return view('auth.login');
        }
//        return view('home');
    }
}
