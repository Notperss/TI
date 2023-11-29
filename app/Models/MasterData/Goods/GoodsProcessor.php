<?php

namespace App\Models\Masterdata\Goods;

use App\Models\MasterData\Hardware\Processor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsProcessor extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'processor_id',
    ];

    public function processor()
    {
        return $this->belongsTo(Processor::class, 'processor_id', 'id');
    }
    public function goods()
    {
        return $this->belongsTo(Barang::class, 'goods_id', 'id');
    }

}
