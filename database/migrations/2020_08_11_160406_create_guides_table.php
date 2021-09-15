<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('filename');
            $table->string('address');
            $table->string('phone');

            $table->string('landline_phone'); 
            $table->string('yes_or_no')->nullable(); 
            $table->string('yes_or_no_two')->nullable(); 
            $table->string('home_detection_rate')->nullable(); 
            $table->string('regular_check_up_price')->nullable(); 
            $table->string('doctor_name')->nullable(); 
            $table->string('price_of_the_delivery_service')->nullable(); 
            
            $table->text('offers_services');
            $table->integer('views')->default('0');
            $table->integer('type');
            $table->integer('user_id');
            $table->integer('active');
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
        Schema::dropIfExists('guides');
    }
}
