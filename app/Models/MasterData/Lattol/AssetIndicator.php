<?php

namespace App\Models\MasterData\Lattol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetIndicator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_asset_id',
        'name',
        'description',
    ];

    public function typeAsset()
    {
        return $this->belongsTo(TypeAsset::class, 'type_asset_id');
    }
}
