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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('user_id')->constrained()->onDelele('cascade');
            $table->string('product_id')->nullable();
            $table->string('product_title')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_price')->nullable();
            $table->integer('product_quantity')->nullable();
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
        Schema::dropIfExists('carts');
    }
};