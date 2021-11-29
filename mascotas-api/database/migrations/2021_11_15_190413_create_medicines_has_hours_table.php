<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesHasHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines_has_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicines_id');
            $table->unsignedTinyInteger('hours_id');

            $table->foreign('medicines_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->foreign('hours_id')->references('id')->on('hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines_has_hours', function (Blueprint $table) {
            $table->dropForeign(['medicines_id']);
            $table->dropForeign(['hours_id']);
        });
        Schema::dropIfExists('medicines_has_hours');
    }
}
