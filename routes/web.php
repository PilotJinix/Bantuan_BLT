<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main_Controller;
use App\Http\Controllers\Admin\C_User;

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
Route::post("delete_user_admin/{id}", [C_User::class, "delete_user"])->name("delete_user_admin");
