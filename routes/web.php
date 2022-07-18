<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main_Controller;
use App\Http\Controllers\Admin\C_User;
use App\Http\Controllers\Admin\C_DataPenerima;
use App\Http\Controllers\Admin\C_Perhitungan;
use App\Http\Controllers\Admin\C_Prioritas;
use App\Http\Controllers\Admin\C_Kriteria;
use App\Http\Controllers\Admin\C_Periode;
use App\Http\Controllers\Test\C_Test;
use App\Http\Controllers\Test\C_SubKriteria;
use App\Http\Controllers\Admin\C_Kondisi_Penerima;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get("/", [HomeController::class, "index"])->name("/");


Route::group(['middleware' => ['auth', 'role:Super Admin']], function (){
    Route::post("create_periode", [C_Periode::class, "create_periode"])->name("create_periode");
    Route::post("edit_periode/{id}", [C_Periode::class, "edit_periode"])->name("edit_periode");
    Route::get("delete_periode/{id}", [C_Periode::class, "delete_periode"])->name("delete_periode");

    Route::get("user_admin", [C_User::class, "index"])->name("index_user_admin");
    Route::post("create_user_admin", [C_User::class, "create_user"])->name("create_user_admin");
    Route::post("update_user_admin/{id}", [C_User::class, "edit_user"])->name("update_user_admin");
    Route::get("delete_user_admin/{id}", [C_User::class, "delete_user"])->name("delete_user_admin");

//buat data penerima
    Route::get("penerima_admin",[C_DataPenerima::class,"index"])->name("index_penerima_admin");
//index nama method
    Route::post("create_penerima_admin",[C_DataPenerima::class,"create_penerima"])->name("create_penerima_admin");
    Route::post("edit_penerima_admin/{id}",[C_DataPenerima::class,"edit_penerima"])->name("edit_penerima_admin");
    Route::get("delete_penerima_admin/{id}",[C_DataPenerima::class,"delete_penerima"])->name("delete_penerima_admin");

//Kondisi Ekonomi
    Route::get("kriteria_admin/{kode}", [C_Kriteria::class, "index"])->name("index_kriteria_admin");
    Route::post("create_kriteria_admin/{kode}", [C_Kriteria::class, "create_kriteria"])->name("create_kriteria_admin");
    Route::post("update_kriteria_admin/{id}", [C_Kriteria::class, "edit_kriteria"])->name("update_kriteria_admin");
    Route::get("delete_kriteria_admin/{id}",[C_Kriteria::class,"delete_kriteria"])->name("delete_kriteria_admin");


//leftbartambahanmeli
    Route::get("perhitungan_admin",[C_Perhitungan::class,"index"])->name("index_perhitungan_admin");
//index nama method
    Route::get("prioritas_admin",[C_Prioritas::class,"index"])->name("index_prioritas_admin");


//Skala
    Route::get("skala",[C_Test::class,"index_skala"])->name("index_skala");
    Route::post("create_skala", [C_Test::class, "create_skala"])->name("create_skala");
    Route::post("edit_skala/{id}", [C_Test::class, "edit_skala"])->name("edit_skala");
    Route::get("delete_skala/{id}", [C_Test::class, "delete_skala"])->name("delete_skala");

//Kriteria
    Route::get("kriteria/{kodeskala}",[C_Test::class,"index_kriteria"])->name("index_kriteria");
    Route::post("data-kriteria",[C_Test::class,"data_kriteria"])->name("data_kriteria");
    Route::post("create_kriteria/{kodeskala}", [C_Test::class, "create_kriteria"])->name("create_kriteria");
    Route::post("edit_kriteria/{id}", [C_Test::class, "edit_kriteria"])->name("edit_kriteria");
    Route::get("delete_kriteria/{kode}", [C_Test::class, "delete_kriteria"])->name("delete_kriteria");


//skala kriteria
    Route::post("create_skala_kriteria/{kode}", [C_Test::class, "create_skala_kriteria"])->name("create_skala_kriteria");


// Sub Kriteria
    Route::get("sub_kriteria/{kodekriteria}",[C_SubKriteria::class,"index"])->name("index_sub_kriteria");
    Route::post("data-sub-kriteria",[C_SubKriteria::class,"data_sub_kriteria"])->name("data_sub_kriteria");
    Route::post("create_sub_kriteria/{kodeunik}", [C_SubKriteria::class, "create_sub_kriteria"])->name("create_sub_kriteria");
    Route::post("edit_sub_kriteria/{id}", [C_SubKriteria::class, "edit_sub_kriteria"])->name("edit_sub_kriteria");
    Route::get("delete_sub_kriteria/{kode}", [C_SubKriteria::class, "delete_sub_kriteria"])->name("delete_sub_kriteria");


//skala Sub kriteria
    Route::post("create_skala_sub_kriteria/{kode}", [C_SubKriteria::class, "create_skala_sub_kriteria"])->name("create_skala_sub_kriteria");


// Informasi Penerima Bantuan
    Route::get('informasi-penerima-bantuan', [C_Kondisi_Penerima::class, 'index'])->name('index_informasi');
    Route::get('informasi-penerima-bantuan/detail/{id}', [C_Kondisi_Penerima::class, 'insert_user'])->name('index_user');
    Route::post('informasi-penerima-bantuan/create_user/{kode_unik}', [C_Kondisi_Penerima::class, 'create_user'])->name('create_user_informasi');
    Route::post('informasi-penerima-bantuan/create-hasil/{kode_unik}', [C_Kondisi_Penerima::class, 'create_hasil'])->name('create_user_hasil');
    Route::post('informasi-penerima-bantuan/edit-hasil/{kode_unik}', [C_Kondisi_Penerima::class, 'edit_hasil'])->name('edit_user_hasil');
    Route::get('informasi-penerima-bantuan/rank/{id}', [C_Kondisi_Penerima::class, 'ranking'])->name('ranking');

});

Route::group(['middleware' => ['auth', 'role:Kades']], function (){
    Route::post("create_periode-kades", [C_Periode::class, "create_periode"])->name("create_periode-kades");
    Route::post("edit_periode-kades/{id}", [C_Periode::class, "edit_periode"])->name("edit_periode-kades");
    Route::get("delete_periode-kades/{id}", [C_Periode::class, "delete_periode"])->name("delete_periode-kades");

    //buat data penerima
    Route::get("penerima_admin-kades",[C_DataPenerima::class,"index"])->name("index_penerima_admin-kades");
//index nama method
    Route::post("create_penerima_admin-kades",[C_DataPenerima::class,"create_penerima"])->name("create_penerima_admin-kades");
    Route::post("edit_penerima_admin-kades/{id}",[C_DataPenerima::class,"edit_penerima"])->name("edit_penerima_admin-kades");
    Route::get("delete_penerima_admin-kades/{id}",[C_DataPenerima::class,"delete_penerima"])->name("delete_penerima_admin-kades");

    // Informasi Penerima Bantuan
    Route::get('informasi-penerima-bantuan-kades', [C_Kondisi_Penerima::class, 'index'])->name('index_informasi-kades');
    Route::get('informasi-penerima-bantuan/detail-kades/{id}', [C_Kondisi_Penerima::class, 'insert_user'])->name('index_user-kades');
    Route::post('informasi-penerima-bantuan/create_user-kades/{kode_unik}', [C_Kondisi_Penerima::class, 'create_user'])->name('create_user_informasi-kades');
    Route::post('informasi-penerima-bantuan/create-hasil-kades/{kode_unik}', [C_Kondisi_Penerima::class, 'create_hasil'])->name('create_user_hasil-kades');
    Route::get('informasi-penerima-bantuan/rank-kades/{id}', [C_Kondisi_Penerima::class, 'ranking'])->name('ranking-kades');


//    Route::get("user_admin", [C_User::class, "index"])->name("index_user_admin");
//    Route::post("create_user_admin", [C_User::class, "create_user"])->name("create_user_admin");
//    Route::post("update_user_admin/{id}", [C_User::class, "edit_user"])->name("update_user_admin");
//    Route::get("delete_user_admin/{id}", [C_User::class, "delete_user"])->name("delete_user_admin");

////buat data penerima
//    Route::get("penerima_admin-kades",[C_DataPenerima::class,"index"])->name("index_penerima_admin-kades");
////index nama method
//    Route::post("create_penerima_admin-kades",[C_DataPenerima::class,"create_penerima"])->name("create_penerima_admin-kades");
//    Route::post("edit_penerima_admin-kades/{id}",[C_DataPenerima::class,"edit_penerima"])->name("edit_penerima_admin-kades");
//    Route::get("delete_penerima_admin-kades/{id}",[C_DataPenerima::class,"delete_penerima"])->name("delete_penerima_admin-kades");

////Kondisi Ekonomi
//    Route::get("kriteria_admin/{kode}", [C_Kriteria::class, "index"])->name("index_kriteria_admin");
//    Route::post("create_kriteria_admin/{kode}", [C_Kriteria::class, "create_kriteria"])->name("create_kriteria_admin");
//    Route::post("update_kriteria_admin/{id}", [C_Kriteria::class, "edit_kriteria"])->name("update_kriteria_admin");
//    Route::get("delete_kriteria_admin/{id}",[C_Kriteria::class,"delete_kriteria"])->name("delete_kriteria_admin");
//
//
////leftbartambahanmeli
//    Route::get("perhitungan_admin",[C_Perhitungan::class,"index"])->name("index_perhitungan_admin");
////index nama method
//    Route::get("prioritas_admin",[C_Prioritas::class,"index"])->name("index_prioritas_admin");
//
//
////Skala
//    Route::get("skala",[C_Test::class,"index_skala"])->name("index_skala");
//    Route::post("create_skala", [C_Test::class, "create_skala"])->name("create_skala");
//    Route::post("edit_skala/{id}", [C_Test::class, "edit_skala"])->name("edit_skala");
//    Route::get("delete_skala/{id}", [C_Test::class, "delete_skala"])->name("delete_skala");
//
////Kriteria
//    Route::get("kriteria/{kodeskala}",[C_Test::class,"index_kriteria"])->name("index_kriteria");
//    Route::post("data-kriteria",[C_Test::class,"data_kriteria"])->name("data_kriteria");
//    Route::post("create_kriteria/{kodeskala}", [C_Test::class, "create_kriteria"])->name("create_kriteria");
//    Route::post("edit_kriteria/{id}", [C_Test::class, "edit_kriteria"])->name("edit_kriteria");
//    Route::get("delete_kriteria/{kode}", [C_Test::class, "delete_kriteria"])->name("delete_kriteria");
//
//
////skala kriteria
//    Route::post("create_skala_kriteria/{kode}", [C_Test::class, "create_skala_kriteria"])->name("create_skala_kriteria");
//
//
//// Sub Kriteria
//    Route::get("sub_kriteria/{kodekriteria}",[C_SubKriteria::class,"index"])->name("index_sub_kriteria");
//    Route::post("data-sub-kriteria",[C_SubKriteria::class,"data_sub_kriteria"])->name("data_sub_kriteria");
//    Route::post("create_sub_kriteria/{kodeunik}", [C_SubKriteria::class, "create_sub_kriteria"])->name("create_sub_kriteria");
//    Route::post("edit_sub_kriteria/{id}", [C_SubKriteria::class, "edit_sub_kriteria"])->name("edit_sub_kriteria");
//    Route::get("delete_sub_kriteria/{kode}", [C_SubKriteria::class, "delete_sub_kriteria"])->name("delete_sub_kriteria");
//
//
////skala Sub kriteria
//    Route::post("create_skala_sub_kriteria/{kode}", [C_SubKriteria::class, "create_skala_sub_kriteria"])->name("create_skala_sub_kriteria");
//


});

Route::group(['middleware' => ['auth', 'role:Kadus']], function (){
    Route::post("create_periode-kadus", [C_Periode::class, "create_periode"])->name("create_periode-kadus");
    Route::post("edit_periode-kadus/{id}", [C_Periode::class, "edit_periode"])->name("edit_periode-kadus");
    Route::get("delete_periode-kadus/{id}", [C_Periode::class, "delete_periode"])->name("delete_periode-kadus");

    //buat data penerima
    Route::get("penerima_admin-kadus",[C_DataPenerima::class,"index"])->name("index_penerima_admin-kadus");
//index nama method
    Route::post("create_penerima_admin-kadus",[C_DataPenerima::class,"create_penerima"])->name("create_penerima_admin-kadus");
    Route::post("edit_penerima_admin-kadus/{id}",[C_DataPenerima::class,"edit_penerima"])->name("edit_penerima_admin-kadus");
    Route::get("delete_penerima_admin-kadus/{id}",[C_DataPenerima::class,"delete_penerima"])->name("delete_penerima_admin-kadus");

    // Informasi Penerima Bantuan
    Route::get('informasi-penerima-bantuan-kadus', [C_Kondisi_Penerima::class, 'index'])->name('index_informasi-kadus');
    Route::get('informasi-penerima-bantuan/detail-kadus/{id}', [C_Kondisi_Penerima::class, 'insert_user'])->name('index_user-kadus');
    Route::post('informasi-penerima-bantuan/create_user-kadus/{kode_unik}', [C_Kondisi_Penerima::class, 'create_user'])->name('create_user_informasi-kadus');
    Route::post('informasi-penerima-bantuan/create-hasil-kadus/{kode_unik}', [C_Kondisi_Penerima::class, 'create_hasil'])->name('create_user_hasil-kadus');
    Route::post('informasi-penerima-bantuan/edit-hasil-kadus/{kode_unik}', [C_Kondisi_Penerima::class, 'edit_hasil'])->name('edit_user_hasil-kadus');
    Route::get('informasi-penerima-bantuan/rank-kadus/{id}', [C_Kondisi_Penerima::class, 'ranking'])->name('ranking-kadus');







//    Route::get("user_admin", [C_User::class, "index"])->name("index_user_admin");
//    Route::post("create_user_admin", [C_User::class, "create_user"])->name("create_user_admin");
//    Route::post("update_user_admin/{id}", [C_User::class, "edit_user"])->name("update_user_admin");
//    Route::get("delete_user_admin/{id}", [C_User::class, "delete_user"])->name("delete_user_admin");
//
//
////Kondisi Ekonomi
//    Route::get("kriteria_admin/{kode}", [C_Kriteria::class, "index"])->name("index_kriteria_admin");
//    Route::post("create_kriteria_admin/{kode}", [C_Kriteria::class, "create_kriteria"])->name("create_kriteria_admin");
//    Route::post("update_kriteria_admin/{id}", [C_Kriteria::class, "edit_kriteria"])->name("update_kriteria_admin");
//    Route::get("delete_kriteria_admin/{id}",[C_Kriteria::class,"delete_kriteria"])->name("delete_kriteria_admin");
//
//
////leftbartambahanmeli
//    Route::get("perhitungan_admin",[C_Perhitungan::class,"index"])->name("index_perhitungan_admin");
////index nama method
//    Route::get("prioritas_admin",[C_Prioritas::class,"index"])->name("index_prioritas_admin");
//
//
////Skala
//    Route::get("skala",[C_Test::class,"index_skala"])->name("index_skala");
//    Route::post("create_skala", [C_Test::class, "create_skala"])->name("create_skala");
//    Route::post("edit_skala/{id}", [C_Test::class, "edit_skala"])->name("edit_skala");
//    Route::get("delete_skala/{id}", [C_Test::class, "delete_skala"])->name("delete_skala");
//
////Kriteria
//    Route::get("kriteria/{kodeskala}",[C_Test::class,"index_kriteria"])->name("index_kriteria");
//    Route::post("data-kriteria",[C_Test::class,"data_kriteria"])->name("data_kriteria");
//    Route::post("create_kriteria/{kodeskala}", [C_Test::class, "create_kriteria"])->name("create_kriteria");
//    Route::post("edit_kriteria/{id}", [C_Test::class, "edit_kriteria"])->name("edit_kriteria");
//    Route::get("delete_kriteria/{kode}", [C_Test::class, "delete_kriteria"])->name("delete_kriteria");
//
//
////skala kriteria
//    Route::post("create_skala_kriteria/{kode}", [C_Test::class, "create_skala_kriteria"])->name("create_skala_kriteria");
//
//
//// Sub Kriteria
//    Route::get("sub_kriteria/{kodekriteria}",[C_SubKriteria::class,"index"])->name("index_sub_kriteria");
//    Route::post("data-sub-kriteria",[C_SubKriteria::class,"data_sub_kriteria"])->name("data_sub_kriteria");
//    Route::post("create_sub_kriteria/{kodeunik}", [C_SubKriteria::class, "create_sub_kriteria"])->name("create_sub_kriteria");
//    Route::post("edit_sub_kriteria/{id}", [C_SubKriteria::class, "edit_sub_kriteria"])->name("edit_sub_kriteria");
//    Route::get("delete_sub_kriteria/{kode}", [C_SubKriteria::class, "delete_sub_kriteria"])->name("delete_sub_kriteria");
//
//
////skala Sub kriteria
//    Route::post("create_skala_sub_kriteria/{kode}", [C_SubKriteria::class, "create_skala_sub_kriteria"])->name("create_skala_sub_kriteria");
//



});
