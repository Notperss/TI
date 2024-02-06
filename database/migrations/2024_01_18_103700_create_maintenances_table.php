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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->nullable();
            $table->bigInteger('goods_id')->nullable();
            $table->string('reporter');
            $table->string('report_number');
            $table->string('type_malfunction')->nullable();
            // $table->string('asset_user');
            $table->date('date');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
};
