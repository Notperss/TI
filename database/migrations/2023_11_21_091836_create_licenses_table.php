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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('name_app');
            $table->string('type_app');
            $table->string('product');
            $table->string('name_vendor');
            $table->string('version');
            $table->date('date_start');
            $table->date('date_finish');
            $table->string('pp');
            $table->string('barcode');
            $table->string('num_of_licenses');
            $table->longText('description');
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
        Schema::dropIfExists('licenses');
    }
};
