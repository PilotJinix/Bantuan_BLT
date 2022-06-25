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
                "l_tfn" => 1.000,
                "f_tfn" => 1.000,
                "n_tfn" => 1.000,
                "l_reciprocal" => 1.000,
                "f_reciprocal" => 1.000,
                "n_reciprocal" => 1.000,
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 0.500,
                "f_tfn" => 1.000,
                "n_tfn" => 1.500,
                "l_reciprocal" => 0.667,
                "f_reciprocal" => 1.000,
                "n_reciprocal" => 2.000,
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 1.000,
                "f_tfn" => 1.500,
                "n_tfn" => 2.000,
                "l_reciprocal" => 0.500,
                "f_reciprocal" => 0.667,
                "n_reciprocal" => 1.000,
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 1.500,
                "f_tfn" => 2.000,
                "n_tfn" => 2.500,
                "l_reciprocal" => 0.400,
                "f_reciprocal" => 0.500,
                "n_reciprocal" => 0.667,
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 2.000,
                "f_tfn" => 2.500,
                "n_tfn" => 3.000,
                "l_reciprocal" => 0.333,
                "f_reciprocal" => 0.400,
                "n_reciprocal" => 0.500,
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 2.500,
                "f_tfn" => 3.000,
                "n_tfn" => 3.500,
                "l_reciprocal" => 0.285,
                "f_reciprocal" => 0.333,
                "n_reciprocal" => 0.400,
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 3.000,
                "f_tfn" => 3.500,
                "n_tfn" => 4.000,
                "l_reciprocal" => 0.250,
                "f_reciprocal" => 0.285,
                "n_reciprocal" => 0.333,
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 3.500,
                "f_tfn" => 4.000,
                "n_tfn" => 4.500,
                "l_reciprocal" => 0.222,
                "f_reciprocal" => 0.250,
                "n_reciprocal" => 0.285,
                "keterangan" => "Intermediate",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);

        DB::table("master_inverse_tfn")
            ->insert([
                "kode_unik" => Uuid::uuid1()->toString(),
                "l_tfn" => 4.000,
                "f_tfn" => 4.500,
                "n_tfn" => 4.500,
                "l_reciprocal" => 0.222,
                "f_reciprocal" => 0.220,
                "n_reciprocal" => 0.250,
                "keterangan" => "One elements are equally important",
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);
    }
}
