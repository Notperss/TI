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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('no_demand');
            $table->string('type_demand');
            $table->date('date_demand');
            $table->date('date_pj')->nullable();
            $table->string('nominal');
            $table->string('accountability')->nullable();
            $table->longText('description');
            $table->string('file')->nullable();
            $table->string('file_pj')->nullable();
            $table->string('nominal_pj')->nullable();
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
        Schema::dropIfExists('demands');
    }
};
