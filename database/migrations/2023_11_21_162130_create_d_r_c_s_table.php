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
        Schema::create('d_r_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('path_source');
            $table->string('path_backup');
            $table->string('path_drc');
            $table->string('backup_frequency');
            $table->string('backup_time');
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
        Schema::dropIfExists('d_r_c_s');
    }
};
