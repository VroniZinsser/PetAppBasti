<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHasUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_user_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('user_types_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_types_id')->references('id')->on('user_types');
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
        Schema::table('users_has_user_types', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_types_id']);
        });
        Schema::dropIfExists('users_has_user_types');
    }
}
