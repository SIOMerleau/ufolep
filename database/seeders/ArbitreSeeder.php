<?php
namespace Database\Seeders;

use App\Models\Arbitre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArbitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('arbitre')->insert([
            ['idCompte' => 12],
            ['idCompte' => 16],
            ['idCompte' => 18],
            ['idCompte' => 32],
            ['idCompte' => 34],
            ['idCompte' => 35],
            ['idCompte' => 46],
            ['idCompte' => 49],
            ['idCompte' => 62],
            ['idCompte' => 63],
            ['idCompte' => 70],
            ['idCompte' => 80],
            ['idCompte' => 308],
            ['idCompte' => 314],
            ['idCompte' => 320],
            ['idCompte' => 321],
            ['idCompte' => 325],
            ['idCompte' => 361],
        ]);*/
        Arbitre::create([
            'idCompte' => 12,
        ]);
    }
}
