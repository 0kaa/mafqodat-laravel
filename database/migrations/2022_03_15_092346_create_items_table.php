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
            $table->enum('report_type', ['lost', 'found']);
            $table->integer('report_number')->unique();
            $table->timestamp('date')->nullable();
            $table->timestamp('time')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->unsignedBigInteger('storage_id');
            // $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('station_id');
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->boolean('is_delivered')->default(0)->nullable();

            /* informer data */
            $table->string('informer_name')->nullable();
            $table->string('informer_phone')->nullable();

            /* User data */
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('delivery_date')->nullable();

            $table->softDeletes();

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
