<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
//untuk manggil model user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_User extends Controller
{
    public function index(){
        $data_user = DB::table("users")
            ->where("role", "!=", "Super Admin")
            ->get();
        return view("Admin.User.index", compact("data_user"));
    }

    public function create_user(Request $request){
        $request->validate([
            "nama_pengguna" => "required",
            "nik" => "required",
            "username" => "required",
            "no_hp" => "required",
            "sandi" => "required",
            "role" => "required",
        ]);

        try {
            $input["nama"] = $request->nama_pengguna;
            $input["nik"] = $request->nik;
            $input["username"] = $request->username;
            $input["no_hp"] = $request->no_hp;
            $input["password"] = bcrypt($request->sandi);
            $input["role"] = $request->role;

            User::create($input);
            return redirect(route("index_user_admin"));

        }catch (\Exception $exception){
            return redirect()->back()->withInput();
        }
    }

    public function edit_user(Request $request, $id){
        $request->validate([
            "nama_pengguna" => "required",
            "nik" => "required",
            "username" => "required",
            "no_hp" => "required",
            "role" => "required",
        ]);

        try {
            if ($request->sandi != ""){
                $input["password"] = bcrypt($request->sandi);
            }
            $input["nama"] = $request->nama_pengguna;
            $input["nik"] = $request->nik;
            $input["username"] = $request->username;
            $input["no_hp"] = $request->no_hp;
            $input["role"] = $request->role;

            User::where("id", $id)->update($input);

            return redirect(route("index_user_admin"));
        }catch (\Exception $exception){
            return redirect()->back();

        }
    }

    public function delete_user($id){
        User::where("id", $id)->delete();
        return redirect()->back();
    }
}
