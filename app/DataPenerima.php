<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPenerima extends Model
{
    protected $table="datapenerima";
    //inisialisasi nama tabel 
    protected $fillable=[
        //inisialisasi nama kolom
        "nik","nama","alamat"
    ];
}
