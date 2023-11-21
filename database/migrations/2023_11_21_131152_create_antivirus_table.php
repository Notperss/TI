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
        Schema::create('antivirus', function (Blueprint $table) {
            $table->id();
            $table->string('name_antivirus');
            $table->year('year');
            $table->string('num_of_licenses');
            $table->date('date_start');
            $table->date('date_finish');
            $table->string('stats');
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
        Schema::dropIfExists('antiviri');
    }
};
