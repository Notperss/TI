<?php

use App\Models\Inspection\Inspection;
use Illuminate\Support\Facades\Schema;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\MasterData\HardwareCategory\HardwareTesting;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_testing_assets', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Barang::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('asset_id');
            $table->foreignIdFor(Inspection::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(HardwareTesting::class)->constrained()->onDelete('cascade');
            $table->integer('number');
            $table->string('result');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('inspection_testing_assets');
    }
};
