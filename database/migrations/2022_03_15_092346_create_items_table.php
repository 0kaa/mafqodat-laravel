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
            /* Lost item data */
            $table->id();
            $table->string('details');
            $table->timestamp('date')->nullable();
            $table->timestamp('time')->nullable();
            $table->string('storage');
            $table->string('image')->nullable();
            $table->string('primary_colour');
            $table->string('secondary_colour')->nullable();
            $table->string('tertiary_colour')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->boolean('is_delivered')->nullable();

            /* User data */
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('address')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();

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
