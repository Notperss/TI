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
        Schema::create('lending_facilities', function (Blueprint $table) {
            $table->id();
            $table->date('date_lend');
            $table->date('date_return');
            $table->string('borrower');
            $table->string('description');
            $table->longText('note');
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
        Schema::dropIfExists('lending_facilities');
    }
};
