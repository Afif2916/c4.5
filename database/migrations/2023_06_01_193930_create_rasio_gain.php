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
        Schema::create('rasio_gain', function (Blueprint $table) {
            $table->id();
            $table->string('opsi');
            $table->string('cabang1');
            $table->string('cabang2');
            $table->double('rasio_gain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rasio_gain');
    }
};
