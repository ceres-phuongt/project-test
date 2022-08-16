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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('model', 255)->nullable();
            $table->string('make', 255)->nullable();
            $table->string('engine_size', 255)->nullable();
            $table->string('registration', 255)->nullable();
            $table->float('price', 255)->nullable()->(0);
            $table->string('image', 255)->nullable();
            $table->integer('user_id')->default(0);
            $table->string('status', 255)->default('pending');
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
        Schema::dropIfExists('cars');
    }
};
