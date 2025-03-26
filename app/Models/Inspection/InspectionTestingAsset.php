<?php

namespace App\Models\Inspection;

use App\Models\MasterData\Goods\Barang;
use App\Models\MasterData\HardwareCategory\HardwareTesting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTestingAsset extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'inspection_id', 'hardware_testing_id', 'testing_name', 'number', 'result', 'description'];

    public function asset()
    {
        return $this->belongsTo(Barang::class);
    }

    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
    public function hardwareTesting()
    {
        return $this->belongsTo(HardwareTesting::class);
    }
}
