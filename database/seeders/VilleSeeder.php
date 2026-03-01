<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $villes = [
            ['idVille' => 1, 'nomVille' => 'Breuil-Magné', 'codePostal' => 17870],
            ['idVille' => 2, 'nomVille' => 'Tulle', 'codePostal' => 19000],
            ['idVille' => 5, 'nomVille' => 'Rochefort', 'codePostal' => 17300],
            ['idVille' => 7, 'nomVille' => 'Marans', 'codePostal' => 17230],
            ['idVille' => 8, 'nomVille' => 'Benon', 'codePostal' => 17170],
            ['idVille' => 9, 'nomVille' => 'Bords', 'codePostal' => 17430],
            ['idVille' => 10, 'nomVille' => 'Burie', 'codePostal' => 17770],
            ['idVille' => 11, 'nomVille' => 'Solinois', 'codePostal' => 17220],
            ['idVille' => 12, 'nomVille' => 'La Rochelle', 'codePostal' => 17000],
            ['idVille' => 13, 'nomVille' => 'Saint-Hyppolyte', 'codePostal' => 17430]
        ];

        foreach ($villes as $ville) {
            DB::table('ville')->insert($ville);
        }
    }
}
