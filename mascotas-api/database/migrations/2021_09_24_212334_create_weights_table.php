<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedSmallInteger('weight');
            $table->unsignedBigInteger('pets_id');
            $table->foreign('pets_id')->references('id')->on('pets');
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
        Schema::table('weights', function (Blueprint $table){
           $table->dropForeign(['pets_id']);
        });
        Schema::dropIfExists('weights');
    }
}
