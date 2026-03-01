<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('detailmatch', function (Blueprint $table) {
            $table->id('idMatch');
            $table->integer('pointsA');
            $table->integer('pointsB');
            $table->integer('idJR');
            $table->enum('lettreR', ['A', 'B', 'C', 'D']);
            $table->integer('idJV');
            $table->enum('lettreV', ['X', 'Y', 'Z', 'W']);
            $table->integer('idRencontre');
            $table->integer('M1')->nullable();
            $table->integer('M2')->nullable();
            $table->integer('M3')->nullable();
            $table->integer('M4')->nullable();
            $table->integer('M5')->nullable();
            $table->integer('M1B')->nullable();
            $table->integer('M2B')->nullable();
            $table->integer('M3B')->nullable();
            $table->integer('M4B')->nullable();
            $table->integer('M5B')->nullable();
            $table->integer('classementJoueurA')->nullable();
            $table->integer('classementJoueurB')->nullable();
            $table->timestamps();

            $table->foreign('idRencontre')->references('idRencontre')->on('rencontre');
            $table->foreign('idJR')->references('idJoueur')->on('joueur');
            $table->foreign('idJV')->references('idJoueur')->on('joueur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailmatch');
    }
};
