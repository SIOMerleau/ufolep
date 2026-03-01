<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoueurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    //migration table joueur
    {
        Schema::create('joueur', function (Blueprint $table) {
            $table->id('idJoueur');
            $table->string('licenceJoueur', 32);
            $table->unsignedBigInteger('idClub');
            $table->boolean('visible')->comment('Défini par le choix du joueur lors de son inscription au club.');
            $table->unsignedBigInteger('idEquipe');
            $table->integer('classement')->default(500)->comment('Classement Ufolep');
            $table->integer('classement_inter')->default(500)->comment('Classement Intersaison pour les bascules');
            $table->integer('classement_fftt')->default(0);
            $table->unsignedBigInteger('idPersonne')->nullable();

            //Clé étrangère
            $table->foreign('idClub')->references('idClub')->on('club')->onDelete('cascade');
            $table->foreign('idPersonne')->references('idPersonne')->on('personne')->onDelete('cascade');
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
        Schema::dropIfExists('joueur');
    }
}

