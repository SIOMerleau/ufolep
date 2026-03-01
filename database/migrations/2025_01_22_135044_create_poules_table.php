<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('poule', function (Blueprint $table) {
            $table->id('idPoule');
            $table->integer('idEquipe');
            $table->integer('idChampionnat');
            $table->enum('nomPoule', ['A', 'B', 'C', 'D', 'E', 'F']);
            $table->timestamps();

            //Clé étrangère idEquipe & idChampionnat
            $table->foreign('idEquipe')->references('idEquipe')->on('equipe');
            $table->foreign('idChampionnat')->references('idChampionnat')->on('championnat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poule');
    }
};
