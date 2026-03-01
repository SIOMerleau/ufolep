<?php

namespace Database\Seeders;

use App\Models\Aide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AideSeeder extends Seeder
{
    //Démarrer le seeder
    public function run(): void
    {
        //Insertion des données dans la table Aide
        Aide::create([
            'titre_aide' => 'Comment créer une feuille de match à 4 joueurs pour SMASH',
            'lien' => 'https://tube-sciences-technologies.apps.education.fr/w/5CaHjAgnuWifpaPHrKeXpb',
        ]);
    }
}
