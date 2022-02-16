<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_pets', function (Blueprint $table) {
            $table->id();
            $table->boolean('accepted')->nullable();
            $table->text('description')->nullable();
            $table->date('expiration_date');
            $table->unsignedBigInteger('pets_id');
            $table->unsignedBigInteger('owners_id')->nullable();
            $table->unsignedBigInteger('professionals_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pets_id')->references('id')->on('pets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('owners_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('professionals_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shared_pets', function (Blueprint $table) {
            $table->dropForeign(['pets_id']);
            $table->dropForeign(['owners_id']);
            $table->dropForeign(['professionals_id']);
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('shared_pets');
    }
}
