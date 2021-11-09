<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('breed', 45)->nullable();
            $table->string('temperament', 45)->nullable();
            $table->boolean('neutered')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('observation')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('images_id');
            $table->unsignedTinyInteger('sexes_id');
            $table->unsignedTinyInteger('species_id');
            $table->foreign('images_id')->references('id')->on('images');
            $table->foreign('sexes_id')->references('id')->on('sexes');
            $table->foreign('species_id')->references('id')->on('species');
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
        Schema::table('pets', function (Blueprint $table){
           $table->dropForeign(['images_id']);
           $table->dropForeign(['sexes_id']);
           $table->dropForeign(['species_id']);
        });
        Schema::dropIfExists('pets');
    }
}
