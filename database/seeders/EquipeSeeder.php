<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipe;

class EquipeSeeder extends Seeder
{
    //Démarrer le seeder
    public function run(): void
    {
        //Données à insérer
        $data = [
            [1, 'Breuil-Magné 1', 1, 1, 29, 7, '', 72, 68, 0, 0],
            [4, 'Marans 1', 4, 1, 32, 7, '', 88, 32, 0, 0],
            [5, 'Benon 1', 5, 1, 16, 7, '', 42, 68, 0, 0],
            [6, 'Bords 1', 7, 1, 20, 7, '', 53, 57, 0, 0],
            [8, 'Loisirs Solinois 1', 9, 1, 29, 7, '', 70, 60, 0, 0],
            [9, 'Smash LR 1', 10, 1, 12, 8, '', 35, 36, 0, 0],
            [10, 'St Hippolyte 1', 11, 1, 0, 2, 'A', 0, 0, 0, 0],
            [11, 'Benon 2', 5, 1, 20, 7, '', 40, 70, 0, 0],
            [12, 'Bords 3', 7, 2, 22, 8, '', 54, 65, 0, 0],
            [13, 'Bords 4', 7, 2, 15, 8, '', 36, 54, 0, 0],
            [14, 'Benon 3', 5, 2, 1, 3, 'B', 4, 6, 0, 0],
            [15, 'St Hippolyte 3', 11, 2, 0, 3, 'B', 0, 0, 0, 0],
            [16, 'CTT Burie 1', 8, 2, 0, 3, '', 0, 0, 0, 0],
            [17, 'Bords 2', 7, 2, 25, 8, '', 59, 41, 0, 0],
            [18, 'St Hippolyte 2', 11, 2, 0, 3, 'A', 0, 0, 0, 0],
            [19, 'Breuil-Magné 2', 1, 2, 4, 3, 'B', 6, 14, 0, 0],
            [20, 'Loisirs solinois 2', 9, 2, 18, 8, '', 53, 47, 0, 0],
            [21, 'Marans 2', 4, 2, 25, 8, '', 49, 43, 0, 0],
            [22, 'Benon 4', 5, 2, 0, 3, 'B', 0, 0, 0, 0],
            [24, 'Loisirs Solinois 3', 9, 2, 0, 0, NULL, 0, 0, 0, 0],
        ];

        //Insertion des données dans la table Equipe
        foreach($data as $row){
            Equipe::create([
                'idEquipe' => $row[0],
                'nomEquipe' => $row[1],
                'idClub' => $row[2],
                'idDivision' => $row[3],
                'nbPts' => $row[4],
                'idChampionnat' => $row[5],
                'nomPoule' => $row[6],
                'matchesGagnes' => $row[7],
                'matchesPerdus' => $row[8],
                'manchesGagnees' => $row[9],
                'manchesPerdues' => $row[10],
            ]);
        }
        
    }
}
