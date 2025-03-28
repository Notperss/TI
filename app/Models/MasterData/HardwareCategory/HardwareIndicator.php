<?php

namespace App\Models\MasterData\HardwareCategory;

use App\Models\Inspection\InspectionIndicatorAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HardwareIndicator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hardware_category_id',
        'name',
        'description',
    ];
    public function hardwareCategory()
    {
        return $this->belongsTo(HardwareCategory::class, 'hardware_category_id');
    }
    public function inspectionAssets()
    {
        return $this->hasMany(InspectionIndicatorAsset::class);
    }
}
