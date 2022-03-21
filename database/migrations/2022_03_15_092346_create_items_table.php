<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('missing_location');
            $table->string('missing_description')->nullable();
            $table->date('missing_date');
            $table->date('missing_time');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('primary_colour');
            $table->string('secondary_colour')->nullable();
            $table->string('tertiary_colour')->nullable();
            $table->string('first_name');
            $table->string('surname');
            $table->string('address');
            $table->string('secondary_address')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->string('email');

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
        Schema::dropIfExists('items');
    }
};
