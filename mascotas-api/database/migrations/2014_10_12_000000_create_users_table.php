<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email', 60)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('email_visible')->nullable()->default(false);
            $table->string('password', 60);
            $table->string('country', 60)->nullable();
            $table->string('state', 60)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('district', 60)->nullable();
            $table->string('street', 60)->nullable();
            $table->string('house_number', 5)->nullable();
            $table->string('apartment', 10)->nullable();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->string('dni', 15)->nullable();
            $table->string('public_name', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('instagram', 30)->nullable();
            $table->string('facebook', 50)->nullable();
            $table->string('web', 50)->nullable();
            $table->boolean('verified')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
