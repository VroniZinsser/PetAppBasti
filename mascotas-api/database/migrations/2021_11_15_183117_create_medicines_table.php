<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('quantity', 60);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('pets_id');
            $table->timestamps();

            $table->foreign('pets_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['pets_id']);
        });
        Schema::dropIfExists('medicines');
    }
}
