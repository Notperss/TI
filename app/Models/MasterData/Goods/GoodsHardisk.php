<?php

namespace App\Models\MasterData\Goods;

use App\Models\MasterData\Hardware\Hardisk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsHardisk extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'hardisk_id',
    ];

    public function hardisk()
    {
        return $this->belongsTo(Hardisk::class, 'hardisk_id', 'id');
    }
    public function goods()
    {
        return $this->belongsTo(Barang::class, 'goods_id', 'id');
    }
}
