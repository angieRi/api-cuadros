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
        Schema::create('cuadros', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('title')->nullable();
            $table->string('paint',150);
            $table->integer('year');
            $table->mediumText('material')->nullable();
            $table->string('measures',30)->nullable();
            $table->string('country',40);
            $table->integer('statu',40);
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
        Schema::dropIfExists('cuadros');
    }
};
