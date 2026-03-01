<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Démarrer la migration
    public function up(): void
    {
        Schema::create('journee', function (Blueprint $table) {
            $table->id('idJournee');
            $table->integer('numJournee');
            $table->date('datePrev')->nullable();
            $table->integer('idChampionnat');
            $table->timestamps();
            //Clé étrangère idChampionnat
            $table->foreign('idChampionnat')->references('idChampionnat')->on('championnat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journee');
    }
};
