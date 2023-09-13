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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->unique();
            
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('order_id')->references('id')->on('orders');

            $table->string('message')->nullable();
            $table->string('reference')->nullable();
            $table->string('status')->nullable();
            $table->string('trans')->nullable();
            $table->string('transaction')->nullable();
            $table->string('trxref')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
