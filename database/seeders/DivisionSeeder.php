<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([
            ['idDivision' => 1, 'nomDivision' => 'Division 1'],
            ['idDivision' => 2, 'nomDivision' => 'Division 2']
        ]);
    }
}
