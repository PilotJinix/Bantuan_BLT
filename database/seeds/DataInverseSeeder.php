<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DataInverseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "1,1,1",
                "reciprocal" => "1,1,1",
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "0.500,1,1.500",
                "reciprocal" => "0.667,1,2",
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "1,1.500,2",
                "reciprocal" => "0.500,0.667,1",
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "1.500,2,2.500",
                "reciprocal" => "0.400,1.500,0.667",
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "2,2.500,3",
                "reciprocal" => "0.333,0.400,0.500",
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "2.500,3,3.500",
                "reciprocal" => "0.285,0.333,0.400",
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "3,3.500,4",
                "reciprocal" => "0.250,0.285,0.333",
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "3.500,4,4.500",
                "reciprocal" => "0.222,0.250,0.285",
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "tfn" => "4,4.500,4.500",
                "reciprocal" => "0.222,0.222,0.250",
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);
    }
}
