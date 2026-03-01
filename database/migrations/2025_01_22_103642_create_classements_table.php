<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('classement', function (Blueprint $table) {
            $table->id('idClassement');
            $table->unsignedBigInteger('idChampionnat');
            $table->unsignedBigInteger('idEquipe');
            $table->integer('nbPoints');
            $table->integer('matchesGagnes');
            $table->integer('matchesPerdus');
            $table->timestamps();
            
            //Clé étrangères
            $table->foreign('idChampionnat')->references('idChampionnat')->on('championnat');
            $table->foreign('idEquipe')->references('idEquipe')->on('equipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classement');
    }
};
