<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChampionnatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('championnat')->insert([
            ['idChampionnat' => 7, 'nomChampionnat' => 'Championnat 2022', 'typeChampionnat' => 'Départemental', 'idDivision' => 1, 'nomPoule' => NULL],
            ['idChampionnat' => 8, 'nomChampionnat' => 'Championnat 2022', 'typeChampionnat' => 'Départemental', 'idDivision' => 2, 'nomPoule' => NULL],
            ['idChampionnat' => 9, 'nomChampionnat' => 'Championnat 2023', 'typeChampionnat' => 'Départemental', 'idDivision' => 1, 'nomPoule' => NULL],
            ['idChampionnat' => 10, 'nomChampionnat' => 'Championnat 2023', 'typeChampionnat' => 'Départemental', 'idDivision' => 2, 'nomPoule' => NULL],
            ['idChampionnat' => 11, 'nomChampionnat' => 'Championnat 2024', 'typeChampionnat' => 'Départemental', 'idDivision' => 1, 'nomPoule' => NULL],
            ['idChampionnat' => 12, 'nomChampionnat' => 'Championnat 2024', 'typeChampionnat' => 'Départemental', 'idDivision' => 2, 'nomPoule' => NULL],
            ['idChampionnat' => 13, 'nomChampionnat' => 'Championnat 2025', 'typeChampionnat' => 'Départemental', 'idDivision' => 1, 'nomPoule' => NULL],
            ['idChampionnat' => 14, 'nomChampionnat' => 'Championnat 2025', 'typeChampionnat' => 'Départemental', 'idDivision' => 2, 'nomPoule' => NULL],
        ]);
    }
}
