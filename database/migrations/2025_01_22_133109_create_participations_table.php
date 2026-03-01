<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('participation', function (Blueprint $table) {
            $table->id();
            $table->integer('idJoueur');
            $table->integer('idChampionnat');
            $table->integer('classement');
            $table->timestamps();

            //Clé primaire composite
            //$table->primary(['idJoueur', 'idChampionnat']);

            // Clés étrangères idJoueur et idChampionnat
            $table->foreign('idJoueur')->references('idJoueur')->on('joueur');
            $table->foreign('idChampionnat')->references('idChampionnat')->on('championnat');
            
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participation');
    }
};
