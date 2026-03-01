<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    //Démarrer le Seeder
    public function run(): void
    {
        // Données à insérer
        /*$data = [
[1, 'castillo', 'castillo', 'ARBITRE'],
[12, 'tessiert', 'tessiert', 'ARBITRE'],
[15, 'bonneauc', 'bonneauc', 'ARBITRE'],
[16, 'dulaisb', 'dulaisb', 'ARBITRE'],
[18, 'favreaud', 'favreaud', 'ARBITRE'],
[32, 'choleta', 'choleta', 'ARBITRE'],
[34, 'grassetn', 'grassetn', 'ARBITRE'],
[35, 'grattons', 'grattons', 'ARBITRE'],
[46, 'devanneo', 'devanneo', 'ARBITRE'],
[49, 'guilleminj', 'guilleminj', 'ARBITRE'],
[62, 'jolyj', 'jolyj', 'ARBITRE'],
[63, 'lhostej', 'lhostej', 'ARBITRE'],
[70, 'gautierb', 'gautierb', 'ARBITRE'],
[80, 'retailleaur', 'retailleaur', 'ARBITRE'],
[308, 'lizots', 'lizots', 'ARBITRE'],
[314, 'simon', 'simon', 'GÉRANT'],
[320, 'oseguerah', 'oseguerah', 'ARBITRE'],
[321, 'ziniq', 'ziniq', 'ARBITRE'],
[325, 'pruvostf', 'pruvostf', 'ARBITRE'],
[358, 'poupeaum', 'poupeaum', 'GÉRANT'],
[361, 'vanpouckej', 'vanpouckej', 'ARBITRE'],
        ];

        //Insertion des données dans la table
        foreach($data as $row){
            User::create([
                'idCompte' => $row[0],
                'identifiant' => $row[1],
                'password' => Hash::make($row[2]),
                'typeCompte' => $row[3],
                'idPersonne' => null, //Clé étrangère avec la table Personne
                //'password' => Hash::make($row[2]),
            ]);
        }
            */
        //Création d'un administrateur
        User::create([
            'idCompte' => 81,
            'identifiant' => 'admin',
            'password' => Hash::make('adminUfolep'),
            'typeCompte' => 'GÉRANT',
            'idPersonne' => 81, //Clé étrangère avec la table Personne
        ]);
        //Création d'un arbitre
        User::create([
            'idCompte' => 12,
            'identifiant' => 'tessiert',
            'password' => Hash::make('tessiert'),
            'typeCompte' => 'ARBITRE',
            'idPersonne' => 12, //Clé étrangère avec la table Personne
        ]);
    }
}
