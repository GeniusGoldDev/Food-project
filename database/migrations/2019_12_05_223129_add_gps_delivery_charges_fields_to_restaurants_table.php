<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGpsDeliveryChargesFieldsToRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('delivery_charge_type')->default('FIXED');
            $table->decimal('base_delivery_charge', 8, 2)->nullable();
            $table->integer('base_delivery_distance')->nullable();
            $table->decimal('extra_delivery_charge', 8, 2)->nullable();
            $table->integer('extra_delivery_distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            //
        });
    }
}
