<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArbitreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //migration table arbitre 
        Schema::create('arbitre', function (Blueprint $table) {
            $table->id('idArbitre');
            $table->unsignedBigInteger('idCompte');
            $table->foreign('idCompte')->references('idCompte')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('arbitre');
    }
}
