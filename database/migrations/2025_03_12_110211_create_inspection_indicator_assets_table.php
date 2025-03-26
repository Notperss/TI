<?php

use App\Models\Inspection\Inspection;
use App\Models\MasterData\Goods\Barang;
use App\Models\MasterData\HardwareCategory\HardwareIndicator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_indicator_assets', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Barang::class)->constrained()->onDelete('cascade');.
            $table->unsignedBigInteger('asset_id');
            $table->foreignIdFor(Inspection::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(HardwareIndicator::class)->constrained()->onDelete('cascade');
            $table->integer('number');
            $table->string('status');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('inspection_indicator_assets');
    }
};
