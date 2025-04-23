<?php

namespace App\Models\Inspection;

use App\Models\MasterData\Goods\Barang;
use App\Models\MasterData\HardwareCategory\HardwareIndicator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionIndicatorAsset extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'inspection_id', 'hardware_indicator_id', 'indicator_name', 'number', 'status', 'is_approve', 'description'];

    // public function asset()
    // {
    //     return $this->belongsTo(Barang::class);
    // }

    public function asset()
    {
        return $this->belongsTo(Barang::class);
    }
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
    public function hardwareIndicator()
    {
        return $this->belongsTo(HardwareIndicator::class);
    }
}
