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
            $table->integer('type');
            $table->string('name');
            $table->string('birth')->nullable();;
            $table->string('gender')->nullable();;
            $table->string('country')->nullable();;
            $table->string('state')->nullable();;
            $table->string('city')->nullable();;
            $table->string('address')->nullable();
            $table->string('disclosure_price')->nullable();
            $table->text('about_you')->nullable();
            $table->string('license')->nullable();
            $table->string('pharmacy_license')->nullable();
            $table->string('image_of_the_guild_capricorn')->nullable();
            $table->string('Personal_identification_photo')->nullable();
            $table->string('phone')->nullable();;
            $table->string('email')->unique();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('active')->default('0');
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
