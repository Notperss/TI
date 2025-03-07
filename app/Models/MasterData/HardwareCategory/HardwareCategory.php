<?php

namespace App\Models\MasterData\HardwareCategory;

use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HardwareCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'has_indicator',
        'has_testing',
    ];

    public function goods()
    {
        return $this->hasMany(Barang::class);
    }

    public function hardwareIndicators()
    {
        return $this->hasMany(HardwareIndicator::class);
    }
    public function hardwareTestings()
    {
        return $this->hasMany(HardwareTesting::class);
    }
}
