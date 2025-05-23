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
        Schema::create('location_room', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // required
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_room');
    }
};
