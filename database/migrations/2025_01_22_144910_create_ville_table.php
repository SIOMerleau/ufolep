<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //migration table Ville
    {
        Schema::create('ville', function (Blueprint $table) {
            $table->id('idVille');
            $table->string('nomVille', 64);
            $table->integer('codePostal');
            $table->timestamps(); // Ajout des colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ville');
    }
}

