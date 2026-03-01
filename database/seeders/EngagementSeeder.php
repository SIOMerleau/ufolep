<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engagement')->insert([
            ['idEngagement' => 1, 'idEquipe' => 1, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 2, 'idEquipe' => 4, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 3, 'idEquipe' => 5, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 4, 'idEquipe' => 6, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 5, 'idEquipe' => 8, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 6, 'idEquipe' => 11, 'idChampionnat' => 7, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 7, 'idEquipe' => 9, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 8, 'idEquipe' => 12, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 9, 'idEquipe' => 13, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            
            ['idEngagement' => 10, 'idEquipe' => 17, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 11, 'idEquipe' => 20, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 12, 'idEquipe' => 21, 'idChampionnat' => 8, 'nbPoints' => 0, 'matchesGagnes' => 0, 'matchesPerdus' => 0, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 13, 'idEquipe' => 1, 'idChampionnat' => 9, 'nbPoints' => 26, 'matchesGagnes' => 67, 'matchesPerdus' => 63, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 14, 'idEquipe' => 4, 'idChampionnat' => 9, 'nbPoints' => 33, 'matchesGagnes' => 88, 'matchesPerdus' => 42, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 15, 'idEquipe' => 5, 'idChampionnat' => 9, 'nbPoints' => 28, 'matchesGagnes' => 73, 'matchesPerdus' => 47, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 16, 'idEquipe' => 8, 'idChampionnat' => 9, 'nbPoints' => 25, 'matchesGagnes' => 58, 'matchesPerdus' => 42, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 17, 'idEquipe' => 11, 'idChampionnat' => 9, 'nbPoints' => 22, 'matchesGagnes' => 58, 'matchesPerdus' => 52, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 18, 'idEquipe' => 14, 'idChampionnat' => 9, 'nbPoints' => 14, 'matchesGagnes' => 25, 'matchesPerdus' => 104, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 19, 'idEquipe' => 22, 'idChampionnat' => 9, 'nbPoints' => 16, 'matchesGagnes' => 50, 'matchesPerdus' => 69, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 20, 'idEquipe' => 6, 'idChampionnat' => 10, 'nbPoints' => 12, 'matchesGagnes' => 33, 'matchesPerdus' => 7, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 21, 'idEquipe' => 9, 'idChampionnat' => 10, 'nbPoints' => 6, 'matchesGagnes' => 17, 'matchesPerdus' => 43, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 22, 'idEquipe' => 12, 'idChampionnat' => 10, 'nbPoints' => 10, 'matchesGagnes' => 22, 'matchesPerdus' => 28, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 23, 'idEquipe' => 17, 'idChampionnat' => 10, 'nbPoints' => 8, 'matchesGagnes' => 20, 'matchesPerdus' => 20, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 24, 'idEquipe' => 19, 'idChampionnat' => 10, 'nbPoints' => 26, 'matchesGagnes' => 57, 'matchesPerdus' => 63, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 25, 'idEquipe' => 20, 'idChampionnat' => 10, 'nbPoints' => 11, 'matchesGagnes' => 31, 'matchesPerdus' => 9, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 26, 'idEquipe' => 21, 'idChampionnat' => 10, 'nbPoints' => 2, 'matchesGagnes' => 7, 'matchesPerdus' => 13, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 27, 'idEquipe' => 1, 'idChampionnat' => 11, 'nbPoints' => 37, 'matchesGagnes' => 98, 'matchesPerdus' => 12, 'differ' => 7, 'oldScore' => 0, 'scoreFinal' => 7],
            ['idEngagement' => 28, 'idEquipe' => 4, 'idChampionnat' => 11, 'nbPoints' => 35, 'matchesGagnes' => 107, 'matchesPerdus' => 13, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 4],
            ['idEngagement' => 29, 'idEquipe' => 5, 'idChampionnat' => 11, 'nbPoints' => 20, 'matchesGagnes' => 28, 'matchesPerdus' => 72, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 5],
            ['idEngagement' => 30, 'idEquipe' => 8, 'idChampionnat' => 11, 'nbPoints' => 28, 'matchesGagnes' => 52, 'matchesPerdus' => 68, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 6],
            ['idEngagement' => 31, 'idEquipe' => 11, 'idChampionnat' => 11, 'nbPoints' => 15, 'matchesGagnes' => 37, 'matchesPerdus' => 83, 'differ' => 10, 'oldScore' => 0, 'scoreFinal' => 0],
            ['idEngagement' => 32, 'idEquipe' => 20, 'idChampionnat' => 11, 'nbPoints' => 15, 'matchesGagnes' => 34, 'matchesPerdus' => 86, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 2],
            ['idEngagement' => 33, 'idEquipe' => 9, 'idChampionnat' => 12, 'nbPoints' => 14, 'matchesGagnes' => 52, 'matchesPerdus' => 68, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 3],
            ['idEngagement' => 34, 'idEquipe' => 12, 'idChampionnat' => 12, 'nbPoints' => 18, 'matchesGagnes' => 42, 'matchesPerdus' => 58, 'differ' => 8, 'oldScore' => 0, 'scoreFinal' => 2],
            ['idEngagement' => 35, 'idEquipe' => 14, 'idChampionnat' => 12, 'nbPoints' => 32, 'matchesGagnes' => 66, 'matchesPerdus' => 44, 'differ' => 3, 'oldScore' => 0, 'scoreFinal' => 7],
            
            ['idEngagement' => 36, 'idEquipe' => 17, 'idChampionnat' => 12, 'nbPoints' => 21, 'matchesGagnes' => 36, 'matchesPerdus' => 54, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 7],
            ['idEngagement' => 37, 'idEquipe' => 19, 'idChampionnat' => 12, 'nbPoints' => 30, 'matchesGagnes' => 70, 'matchesPerdus' => 40, 'differ' => 4, 'oldScore' => 0, 'scoreFinal' => 4],
            ['idEngagement' => 38, 'idEquipe' => 21, 'idChampionnat' => 12, 'nbPoints' => 20, 'matchesGagnes' => 53, 'matchesPerdus' => 47, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 5],
            ['idEngagement' => 40, 'idEquipe' => 22, 'idChampionnat' => 12, 'nbPoints' => 22, 'matchesGagnes' => 51, 'matchesPerdus' => 59, 'differ' => 4, 'oldScore' => 0, 'scoreFinal' => 6],
            ['idEngagement' => 41, 'idEquipe' => 6, 'idChampionnat' => 11, 'nbPoints' => 16, 'matchesGagnes' => 44, 'matchesPerdus' => 66, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 3],
            ['idEngagement' => 42, 'idEquipe' => 1, 'idChampionnat' => 13, 'nbPoints' => 2, 'matchesGagnes' => 8, 'matchesPerdus' => 12, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 4],
            ['idEngagement' => 43, 'idEquipe' => 4, 'idChampionnat' => 13, 'nbPoints' => 11, 'matchesGagnes' => 25, 'matchesPerdus' => 15, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 6],
            ['idEngagement' => 44, 'idEquipe' => 5, 'idChampionnat' => 13, 'nbPoints' => 5, 'matchesGagnes' => 12, 'matchesPerdus' => 18, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 3],
            ['idEngagement' => 45, 'idEquipe' => 6, 'idChampionnat' => 13, 'nbPoints' => 4, 'matchesGagnes' => 8, 'matchesPerdus' => 22, 'differ' => -3, 'oldScore' => 2, 'scoreFinal' => 5],
            ['idEngagement' => 46, 'idEquipe' => 8, 'idChampionnat' => 13, 'nbPoints' => 6, 'matchesGagnes' => 18, 'matchesPerdus' => 2, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 9],
            ['idEngagement' => 47, 'idEquipe' => 14, 'idChampionnat' => 13, 'nbPoints' => 6, 'matchesGagnes' => 16, 'matchesPerdus' => 24, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 8],
            ['idEngagement' => 48, 'idEquipe' => 20, 'idChampionnat' => 13, 'nbPoints' => 6, 'matchesGagnes' => 13, 'matchesPerdus' => 7, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 7],
            ['idEngagement' => 49, 'idEquipe' => 9, 'idChampionnat' => 14, 'nbPoints' => 1, 'matchesGagnes' => 0, 'matchesPerdus' => 10, 'differ' => -1, 'oldScore' => 1, 'scoreFinal' => 0],
            ['idEngagement' => 50, 'idEquipe' => 11, 'idChampionnat' => 14, 'nbPoints' => 6, 'matchesGagnes' => 14, 'matchesPerdus' => 6, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 8],
            ['idEngagement' => 51, 'idEquipe' => 12, 'idChampionnat' => 14, 'nbPoints' => 4, 'matchesGagnes' => 11, 'matchesPerdus' => 19, 'differ' => 1, 'oldScore' => 2, 'scoreFinal' => 3],
            ['idEngagement' => 52, 'idEquipe' => 17, 'idChampionnat' => 14, 'nbPoints' => 4, 'matchesGagnes' => 11, 'matchesPerdus' => 9, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 4],
            ['idEngagement' => 53, 'idEquipe' => 21, 'idChampionnat' => 14, 'nbPoints' => 3, 'matchesGagnes' => 10, 'matchesPerdus' => 0, 'differ' => -1, 'oldScore' => 9, 'scoreFinal' => 10],
            ['idEngagement' => 54, 'idEquipe' => 22, 'idChampionnat' => 14, 'nbPoints' => 9, 'matchesGagnes' => 24, 'matchesPerdus' => 6, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 9],
            ['idEngagement' => 55, 'idEquipe' => 24, 'idChampionnat' => 14, 'nbPoints' => 5, 'matchesGagnes' => 12, 'matchesPerdus' => 18, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 5],
            ['idEngagement' => 56, 'idEquipe' => 19, 'idChampionnat' => 14, 'nbPoints' => 4, 'matchesGagnes' => 8, 'matchesPerdus' => 22, 'differ' => 0, 'oldScore' => 0, 'scoreFinal' => 5]
        ]);
    }
}