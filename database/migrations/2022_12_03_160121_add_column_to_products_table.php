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
        Schema::table('products', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->after('user_id');
            $table->uuid('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->after('user_id');
            $table->dropColumn('category');
            $table->dropColumn('category_slug');
            $table->dropColumn('sub_category');
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
            $table->dropColumn('subcategory_id');
            $table->dropColumn('category_id');
        });
    }
};