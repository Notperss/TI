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
        Schema::create('act_dailies', function (Blueprint $table) {
            $table->id();
            $table->string('executor');
            $table->bigInteger('users_id')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('finish_date')->nullable();
            $table->text('activity');
            $table->text('description')->nullable();
            $table->bigInteger('work_type_id');
            $table->bigInteger('location_room_id')->nullable();
            $table->string('status')->nullable();
            $table->string('terminal_id')->nullable();
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
        Schema::dropIfExists('act_dailies');
    }
};
