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
        Schema::create('pps', function (Blueprint $table) {
            $table->id();
            $table->string('no_pp');
            $table->year('year');
            $table->date('date');
            $table->string('job_name');
            $table->string('job_value');
            $table->string('rkap');
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
        Schema::dropIfExists('p_p_s');
    }
};
