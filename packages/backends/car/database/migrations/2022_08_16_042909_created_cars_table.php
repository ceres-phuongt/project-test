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
            $table->integer('make_id')->nullable();
            $table->integer('engine_size_id')->nullable();
            $table->text('registration')->nullable();
            $table->decimal('amount', $precision = 15, $scale = 2)->nullable()->default(0);
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
