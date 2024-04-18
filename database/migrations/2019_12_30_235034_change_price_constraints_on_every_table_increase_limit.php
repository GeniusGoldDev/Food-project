<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceConstraintsOnEveryTableIncreaseLimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addons', function (Blueprint $table) {
            //price
            $table->decimal('price', 20, 2)->change();
        });

        Schema::table('items', function (Blueprint $table) {
            //price
            $table->decimal('price', 20, 2)->change();
        });

        Schema::table('orderitems', function (Blueprint $table) {
            //price
            $table->decimal('price', 20, 2)->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            //tax
            //delivery_charge
            //restaurant_charge
            //total
            //payable
            $table->decimal('tax', 20, 2)->nullable()->change();
            $table->decimal('restaurant_charge', 20, 2)->nullable()->change();
            $table->decimal('delivery_charge', 20, 2)->nullable()->change();
            $table->decimal('total', 20, 2)->change();
            $table->decimal('payable', 20, 2)->default(0)->change();
        });

        Schema::table('order_item_addons', function (Blueprint $table) {
            //addon_price
            $table->decimal('addon_price', 20, 2)->change();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            //restaurant_charges
            //delivery_charges
            //base_delivery_charge
            //extra_delivery_charge
            $table->decimal('restaurant_charges', 20, 2)->nullable()->change();
            $table->decimal('delivery_charges', 20, 2)->nullable()->change();
            $table->decimal('base_delivery_charge', 20, 2)->nullable()->change();
            $table->decimal('extra_delivery_charge', 20, 2)->nullable()->change();
        });

        Schema::table('restaurant_earnings', function (Blueprint $table) {
            //amount
            $table->decimal('amount', 20, 2)->default(0)->change();
        });

        Schema::table('restaurant_payouts', function (Blueprint $table) {
            //amount
            $table->decimal('amount', 20, 2)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
