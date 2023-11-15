<?php

namespace App\Models\Adm;

use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'lendingfacility_id',
        'goods_id',
    ];
    public $rules = [
        'lendingfacility' => 'required',
        'goods_id' => 'required',
    ];

    public function lending_facility()
    {
        return $this->belongsTo(LendingFacility::class, 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'goods_id', 'id');
    }
}
