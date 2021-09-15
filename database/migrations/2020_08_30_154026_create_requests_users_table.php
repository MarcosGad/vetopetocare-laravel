<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->bigInteger('user_id');
            $table->integer('type');
            $table->string('address')->nullable();
            $table->string('disclosure_price')->nullable();
            $table->text('about_you')->nullable();
            $table->string('license')->nullable();
            $table->string('pharmacy_license')->nullable();
            $table->string('image_of_the_guild_capricorn')->nullable();
            $table->string('Personal_identification_photo')->nullable();
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
        Schema::dropIfExists('requests_users');
    }
}
