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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('provider_id')->unique()->nullable();
            $table->string('initial')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('dob')->nullable();
            $table->string('is_completed')->boolean()->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('User')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};