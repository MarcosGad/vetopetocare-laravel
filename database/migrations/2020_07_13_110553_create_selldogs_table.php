<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelldogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selldogs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('purpose');
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->string('strain')->nullable();
            $table->string('n_strain')->nullable();
            $table->string('pecial_marque')->nullable();
            $table->string('price');
            $table->string('currency')->nullable();
            $table->string('license')->nullable();
            $table->string('sex')->nullable();
            $table->text('filename');
            $table->text('notes')->nullable();
            $table->integer('views')->default('0');
            $table->tinyInteger('active')->default('0');
            $table->integer('user_id');
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
        Schema::dropIfExists('selldogs');
    }
}
