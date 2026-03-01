<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampionnatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //migration table championnat
        Schema::create('championnat', function (Blueprint $table) {
            $table->id('idChampionnat');
            $table->string('nomChampionnat', 64);
            $table->enum('typeChampionnat', ['Départemental', 'Régional', 'National']);
            $table->unsignedBigInteger('idDivision');
            $table->string('nomPoule', 1)->nullable();

            $table->foreign('idDivision')->references('id')->on('divisions')->onDelete('cascade');
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
        Schema::dropIfExists('championnat');
    }
}
