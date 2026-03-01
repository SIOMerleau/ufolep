<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('club')->insert([
            ['idClub' => 1, 'nomClub' => 'Breuil-Magné', 'sponsor' => 'Carrefour', 'nomSalle' => 'Salle des sports', 'adresseSalle' =>'Complexe sportif du Grand Logis (après le terrain de football) Rue du stade', 'idVille' => 1],
            ['idClub' => 2, 'nomClub' => 'Tulle', 'sponsor' => 'Intermarché', 'nomSalle' => '', 'adresseSalle' => '', 'idVille' => 2],
            ['idClub' => 3, 'nomClub' => 'Rochefort', 'sponsor' => 'Auchan', 'nomSalle' => '', 'adresseSalle' => '', 'idVille' => 5],
            ['idClub' => 4, 'nomClub' => 'Marans / Courcon', 'sponsor' => '', 'nomSalle' => 'Gymnase intercommunal', 'adresseSalle' => 'Avenue du Général De Gaulle', 'idVille' => 7],
            ['idClub' => 5, 'nomClub' => 'Benon', 'sponsor' => '', 'nomSalle' => 'Salle des fêtes Parc du château', 'adresseSalle' => 'Rue du château Musset', 'idVille' => 8],
            ['idClub' => 7, 'nomClub' => 'Bords', 'sponsor' => '', 'nomSalle' => 'Salle des halles', 'adresseSalle' => 'Place Saint-Vivien', 'idVille' => 9],
            ['idClub' => 8, 'nomClub' => 'Burie', 'sponsor' => '', 'nomSalle' => 'Club de tennis de table de Bue', 'adresseSalle' => 'Route du bois Barre', 'idVille' => 10],
            ['idClub' => 9, 'nomClub' => 'Loisirs Solinois', 'sponsor' => '', 'nomSalle' => 'Maison des Associations', 'adresseSalle' => 'Rue de l\'Aunis', 'idVille' => 11],
            ['idClub' => 10, 'nomClub' => 'Smash LR', 'sponsor' => '', 'nomSalle' => 'Salle France Vatré', 'adresseSalle' => 'Rue du vélodrome', 'idVille' => 12],
            ['idClub' => 11, 'nomClub' => 'St Hippolyte', 'sponsor' => '', 'nomSalle' => 'Salle des fêtes', 'adresseSalle' => 'Place Eugène Laugraud', 'idVille' => 13]
        ]);
    }
}
