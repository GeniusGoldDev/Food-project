<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLngHeadingToDeliveryGuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_guy_details', function (Blueprint $table) {
            $table->string('delivery_lat')->nullable();
            $table->string('delivery_long')->nullable();
            $table->string('heading')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_guy_details', function (Blueprint $table) {
            //
        });
    }
}
