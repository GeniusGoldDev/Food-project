<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string("unique_order_id");
            $table->integer("orderstatus_id")->default(1);
            $table->integer('user_id');
            $table->string('coupon_name')->nullable();
            $table->string('location');
            $table->string('address');
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('restaurant_charge', 8, 2)->nullable();
            $table->decimal('delivery_charge', 8, 2)->nullable();
            $table->decimal('total', 8, 2);
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
        Schema::dropIfExists('orders');
    }
}
