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
        Schema::create('network_cctv', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('km');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('link_cctv');
            $table->string('logo');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_cctv');
    }
};
