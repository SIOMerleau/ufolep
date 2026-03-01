<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('rencontre', function (Blueprint $table) {
            $table->id('idRencontre');
            $table->time('heure')->nullable();
            $table->date('date')->nullable();
            $table->string('lieu', 128)->nullable();
            $table->integer('scoreFinalA')->nullable();
            $table->integer('scoreFinalB')->nullable();
            $table->integer('ptsDbA');
            $table->integer('ptsDbB');
            $table->integer('idJournee');
            $table->integer('idArbitre')->nullable();
            $table->integer('idEquipeA');
            $table->integer('idEquipeB');
            $table->enum('victoire', ['A', 'B', 'N', ''])->nullable();
            $table->enum('WO', ['J', 'A', 'B', ''])->nullable()->comment('J = Joué A = Forfait equipeA B = Forfait equipeB');
            $table->integer('D1')->nullable();
            $table->integer('D2')->nullable();
            $table->integer('D3')->nullable();
            $table->integer('D4')->nullable();
            $table->integer('D5')->nullable();
            $table->integer('D1B');
            $table->integer('D2B');
            $table->integer('D3B');
            $table->integer('D4B');
            $table->integer('D5B');
            $table->enum('statut', ['N', 'S'])->default('N');
            $table->enum('verrou', ['O', 'F', 'P', 'E', 'M'])->default('O');
            $table->timestamps();

            //Clé étrangère idJournee, idEquipeA, idEquipeB
            $table->foreign('idJournee')->references('idJournee')->on('journee');
            $table->foreign('idEquipeA')->references('idEquipe')->on('equipe');
            $table->foreign('idEquipeB')->references('idEquipe')->on('equipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencontre');
    }
};
