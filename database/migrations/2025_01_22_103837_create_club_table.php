<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    //migration table club
    {
        Schema::create('club', function (Blueprint $table) {
            $table->id('idClub');
            $table->string('nomClub', 64);
            $table->string('sponsor', 64);
            $table->string('nomSalle', 128);
            $table->string('adresseSalle', 128);
            $table->unsignedBigInteger('idVille');

            $table->primary('idClub');
            $table->foreign('idVille')->references('idVille')->on('ville')->onDelete('cascade');
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
        Schema::dropIfExists('club');
    }
}
