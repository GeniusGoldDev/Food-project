<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryGuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_guy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('description')->nullable();
            $table->string('vehicle_number')->nullable();
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
        Schema::dropIfExists('delivery_guy_details');
    }
}
