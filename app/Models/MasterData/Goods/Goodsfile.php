<?php

namespace App\Models\MasterData\Goods;

use App\Http\Controllers\MasterData\Goods\BarangController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goodsfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'file',
    ];

    public function goods()
    {
        return $this->belongsTo(BarangController::class, 'id');
    }


}
