<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            "nama" => "Super Admin",
            "nik" => "000000000000",
            "no_hp" => "000000000",
            "username" => "Super_Admin",
            "password" => bcrypt("123456789"),
            "role" => "Super Admin"
        ]);

        User::create([
            "nama" => "Admin",
            "nik" => "000000000001",
            "no_hp" => "000000001",
            "username" => "Admin",
            "password" => bcrypt("123456789"),
            "role" => "Admin"
        ]);

        User::create([
            "nama" => "Andy Dharmawan",
            "nik" => "000000000002",
            "no_hp" => "000000002",
            "username" => "Kades_0",
            "password" => bcrypt("123456789"),
            "role" => "Kades"
        ]);

        User::create([
            "nama" => "Dharmawan Andy",
            "nik" => "000000000003",
            "no_hp" => "000000003",
            "username" => "Kadus_0",
            "password" => bcrypt("123456789"),
            "role" => "Kadus"
        ]);
    }
}
