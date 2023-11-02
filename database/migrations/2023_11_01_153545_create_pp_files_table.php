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
        Schema::create('pp_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pp_id');
            $table->string('name_file')->nullable();
            $table->string('type_file')->nullable();
            $table->string('file');
            $table->longText('description_file')->nullable();
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
        Schema::dropIfExists('pp_files');
    }
};
