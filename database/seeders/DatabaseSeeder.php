<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //Appelle de tous les Seeders pour remplir la base de données
    public function run(): void
    {
        $this->call([
            AideSeeder::class,
            DetailmatchSeeder::class,
            EquipeSeeder::class,
            JourneeSeeder::class,
            RencontreSeeder::class,
            ArbitreSeeder::class,
            ChampionnatSeeder::class,
            ClubSeeder::class,
            DivisionSeeder::class,
            EngagementSeeder::class,
            JoueurSeeder::class,
            PersonneSeeder::class,
            UserSeeder::class,
            VilleSeeder::class,
        ]);
    }
}
