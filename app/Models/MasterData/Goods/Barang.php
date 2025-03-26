<?php

namespace App\Models\MasterData\Goods;

use App\Models\Adm\LendingGoods;
use App\Models\Adm\LendingFacility;
use App\Models\Inspection\Inspection;
use App\Models\Maintenance\Maintenance;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManagementAccess\JobPosition;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inspection\InspectionTestingAsset;
use App\Models\Network\Distribution\Distribution;
use App\Models\Inspection\InspectionIndicatorAsset;
use App\Models\Network\Distribution\DistributionAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MasterData\HardwareCategory\HardwareCategory;

class Barang extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "goods";
    protected $fillable = [
        'name',
        'category',
        'type_assets',
        'barcode',
        'sku',
        'brand',
        'stats',
        'size',
        'year',
        'description',
        'job_position_id',
        'hardware_category_id',
        'file',
        'is_inspected',
    ];
    public function lending_goods()
    {
        return $this->hasMany(LendingGoods::class, 'id');
    }
    public function goodsfile()
    {
        return $this->hasMany(Goodsfile::class, 'id');
    }
    public function goodsprocessor()
    {
        return $this->hasMany(GoodsProcessor::class, 'goods_id');
    }
    public function goodsram()
    {
        return $this->hasMany(GoodsRam::class, 'goods_id');
    }
    public function goodshardisk()
    {
        return $this->hasMany(GoodsHardisk::class, 'goods_id');
    }
    public function distribution_asset()
    {
        return $this->hasMany(DistributionAsset::class, 'asset_id', 'id');
    }
    public function dist_asset()
    {
        return $this->hasMany(DistributionAsset::class, 'asset_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'goods_id');
    }

    public function lending_facility()
    {
        return $this->belongsTo(LendingFacility::class, 'id');
    }
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'id');
    }
    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class, );
    }
    public function hardwareCategory()
    {
        return $this->belongsTo(HardwareCategory::class, );
    }
    public function inspectionIndicatorAssets()
    {
        return $this->hasMany(InspectionIndicatorAsset::class, 'asset_id', 'id');
    }
    public function inspectionTestingAssets()
    {
        return $this->hasMany(InspectionTestingAsset::class, 'asset_id', 'id');
    }
    public function inspections()
    {
        return $this->belongsToMany(Inspection::class, 'asset_inspection', 'asset_id', 'inspection_id')->withPivot('file_path');
    }
}
