<?php

namespace App\Models\MasterData\Goods;

use App\Models\MasterData\Hardware\Motherboard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsMotherboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_id',
        'motherboard_id',
    ];

    public function motherboard()
    {
        return $this->belongsTo(Motherboard::class, 'motherboard_id', 'id');
    }
    public function goods()
    {
        return $this->belongsTo(Barang::class, 'goods_id', 'id');
    }
}
