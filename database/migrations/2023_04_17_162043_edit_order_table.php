<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->longText('order_items')->nullable();
            $table->string('payment_option')->nullable();
            $table->string('delivery_option')->nullable();
            $table->string('delivery_status')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->dateTime('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            //
        });
    }
};