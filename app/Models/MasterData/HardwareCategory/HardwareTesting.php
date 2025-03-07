<?php

namespace App\Models\MasterData\HardwareCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HardwareTesting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hardware_category_id',
        'name',
        'description',
    ];

    public function hardwareCategory()
    {
        return $this->belongsTo(HardwareCategory::class);
    }
}
