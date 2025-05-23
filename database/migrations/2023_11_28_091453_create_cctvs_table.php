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
        Schema::create('cctvs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('brand');
            $table->string('location');
            $table->string('maintainer');
            $table->string('type_loc')->nullable();
            $table->string('category');
            $table->string('type_cctv');
            $table->string('ip');
            $table->string('link');
            $table->string('username_cctv');
            $table->string('password_cctv');
            $table->string('lon_lat');
            $table->string('stats');
            $table->date('installation_date');
            $table->string('file')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('cctvs');
    }
};
