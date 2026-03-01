<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('remplacement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idJoueur');
            $table->unsignedBigInteger('idEquipe');
            $table->unsignedBigInteger('idRencontre');
            $table->timestamps();

            //Clé primaire composite
            //$table->primary(['idJoueur', 'idEquipe', 'idRencontre']);

            //Clé étrangère idJoueur, idEquipe et idRencontre
            $table->foreign('idJoueur')->references('idJoueur')->on('joueur');
            $table->foreign('idEquipe')->references('idEquipe')->on('equipe');
            $table->foreign('idRencontre')->references('idRencontre')->on('rencontre');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remplacement');
    }
};
