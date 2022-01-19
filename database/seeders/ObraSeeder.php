<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras')->insert([
            'proprietario' => '',
            'endereco' => '',
            'metragem' => 0.0,
            'cub' => 0.0,
        ]);
    }
}
