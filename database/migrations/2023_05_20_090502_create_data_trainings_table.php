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
        Schema::create('data_trainings', function (Blueprint $table) {
            $table->id();
            $table->string ('resi');
            $table->string('asuransi');
            $table->string('yesstar');
            $table->string('destinasi');
            $table->string('jumlahkiriman');
            $table->string('jeniskiriman');
            $table->string('isikiriman');
            $table->string('tepatwaktu');
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
        Schema::dropIfExists('data_trainings');
    }
};
