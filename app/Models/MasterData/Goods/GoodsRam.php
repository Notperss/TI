<?php

namespace App\Models\MasterData\Goods;

use App\Models\MasterData\Hardware\Ram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsRam extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'ram_id',
    ];

    public function ram()
    {
        return $this->belongsTo(Ram::class, 'ram_id', 'id');
    }
    public function goods()
    {
        return $this->belongsTo(Barang::class, 'goods_id', 'id');
    }
}
