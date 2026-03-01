<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('equipe', function (Blueprint $table) {
            $table->id('idEquipe');
            $table->string('nomEquipe', 32);
            $table->integer('idClub');
            $table->integer('idDivision');
            $table->integer('nbPts')->comment('points du classement');
            $table->integer('idChampionnat');
            $table->string('nomPoule', 1)->nullable();
            $table->integer('matchesGagnes');
            $table->integer('matchesPerdus');
            $table->integer('manchesGagnees');
            $table->integer('manchesPerdues');
            $table->timestamps();

            //Clé étrangère
            $table->foreign('idClub')->references('idClub')->on('club');
            $table->foreign('idDivision')->references('idDivision')->on('division');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipe');
    }
};
