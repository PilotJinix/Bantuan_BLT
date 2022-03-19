<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main_Controller;
use App\Http\Controllers\Admin\C_User;
use App\Http\Controllers\Admin\C_DataPenerima;

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