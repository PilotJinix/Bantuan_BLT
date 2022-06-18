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

Route::get("/", [Main_Controller::class, "index"])->name("/");
Route::post("create_periode", [C_Periode::class, "index"])->name("create_periode");
Route::post("update_periode/{kode}", [C_Periode::class, "edit_periode"])->name("update_periode");
Route::get("delete_periode/{kode}", [C_Periode::class, "delete_periode"])->name("delete_periode");

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


//Test


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

//skala Sub kriteria
Route::post("create_skala_sub_kriteria/{kode}", [C_SubKriteria::class, "create_skala_sub_kriteria"])->name("create_skala_sub_kriteria");
