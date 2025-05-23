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
        Schema::create('ip_phones', function (Blueprint $table) {
            $table->id();
            $table->string('caller');
            $table->string('location');
            $table->string('barcode');
            $table->string('type');
            $table->string('ip');
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
        Schema::dropIfExists('ip_phones');
    }
};
