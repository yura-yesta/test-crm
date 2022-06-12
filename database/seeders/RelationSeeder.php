<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 11111; $i++) {

              DB::table('relations')->insert([
                'id_company' => rand(1, 11111),
                'id_client' => $i,
              ]);

        }
    }
}
