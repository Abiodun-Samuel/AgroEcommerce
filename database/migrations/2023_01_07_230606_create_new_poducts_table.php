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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->unique();

            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');

            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->uuid('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');

            $table->string('brands')->nullable();
            $table->longText('image')->nullable();

            $table->longText('description')->nullable();
            $table->longText('ingredients')->nullable();
            $table->string('pack_size');
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->integer('stock');

            // $table->uuid('review_id')->nullable();
            // $table->foreign('review_id')->references('id')->on('reviews');

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
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};