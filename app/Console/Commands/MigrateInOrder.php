<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $migrations = [
            '2014_10_12_000000_create_users_table.php',
            '2022_03_19_072615_create_datapenerima_table.php',
            '2022_03_20_121216_create_detail_data_penerima_table.php',
            '2022_04_16_091437_create_master_inverse_tfn_table.php',
            '2022_04_03_021936_create_master_skala_table.php',
            '2022_04_03_022218_create_master_kriteria_table.php',
            '2022_06_18_020953_create_master_sub_kriteria_table.php',
//            '2022_04_03_022658_create_sub_kriteria_table.php',
            '2022_04_03_023017_create_skala_kriteria_table.php',
            '2022_06_18_021126_create_skala_sub_kriteria_table.php',
//            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php'
        ];

        foreach($migrations as $migration)
        {
            $basePath = 'database/migrations/';
            $migrationName = trim($migration);
            $path = $basePath.$migrationName;
            $this->call('migrate:fresh', [
                '--seed' => $path ,
            ]);
        }

    }
}
