<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileImageAndCredentialImgToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_img_id')->nullable()->default(13);
            $table->unsignedBigInteger('credential_img_id')->unique()->nullable();
            $table->foreign('profile_img_id')->references('id')->on('images');
            $table->foreign('credential_img_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profile_img_id']);
            $table->dropForeign(['credential_img_id']);
            $table->dropColumn('profile_img_id');
            $table->dropColumn('credential_img_id');
        });
    }
}
