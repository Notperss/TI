<?php

namespace App\Models\MasterData\Lattol;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function assetIndicator()
    {
        return $this->hasMany(AssetIndicator::class);
    }
}
