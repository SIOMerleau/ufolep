<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    //migration table engagement
    {
        Schema::create('engagement', function (Blueprint $table) {
            $table->id('idEngagement');
            $table->unsignedBigInteger('idEquipe');
            $table->unsignedBigInteger('idChampionnat');
            $table->integer('nbPoints')->nullable();
            $table->integer('matchesGagnes')->nullable();
            $table->integer('matchesPerdus')->nullable();
            $table->integer('differ')->nullable();
            $table->integer('oldScore')->nullable();
            $table->integer('scoreFinal')->nullable();

            $table->foreign('idChampionnat')->references('idChampionnat')->on('championnat')->onDelete('cascade');
            $table->foreign('idEquipe')->references('idEquipe')->on('equipe')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engagement');
    }
}
