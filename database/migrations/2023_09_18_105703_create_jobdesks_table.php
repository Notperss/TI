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
        Schema::create('jobdesks', function (Blueprint $table) {
            $table->id();
            $table->string('jobdesk');
            $table->string('year');
            $table->string('general');
            $table->string('technical');
            $table->longText('description');
            $table->interger('type');
            $table->interger('status');
            $table->softDeletes();
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
        Schema::dropIfExists('jobdesks');
    }
};
