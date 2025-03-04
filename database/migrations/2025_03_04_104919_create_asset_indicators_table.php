<?php

use App\Models\MasterData\Lattol\TypeAsset;
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
        Schema::create('asset_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeAsset::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('asset_indikators');
    }
};
