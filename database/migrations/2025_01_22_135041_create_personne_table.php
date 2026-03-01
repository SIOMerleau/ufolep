<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    //migration table personne
    {
        Schema::create('personne', function (Blueprint $table) {
            $table->id('idPersonne');
            $table->string('nom', 64);
            $table->string('prenom', 64);
            $table->integer('age')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('sexe', ['M', 'F']);
            $table->string('mail', 64)->nullable();
            $table->string('adresse', 128)->nullable();
            $table->unsignedBigInteger('idCompte')->nullable();
            $table->unsignedBigInteger('idJoueur')->nullable();
            $table->timestamps(); // Ajout des colonnes created_at et updated_at

            //Clé étrangère
            $table->foreign('idCompte')->references('idCompte')->on('users')->onDelete('cascade');
            $table->foreign('idJoueur')->references('idJoueur')->on('joueur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personne');
    }
}
