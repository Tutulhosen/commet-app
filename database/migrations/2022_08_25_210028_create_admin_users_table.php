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
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->default(3);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cell')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('location')->nullable();
            $table->string('bio')->nullable();
            $table->string('birthday')->nullable();
            $table->string('access_token')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('trash')->default(false);
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
        Schema::dropIfExists('admin_users');
    }
};
