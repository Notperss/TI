<?php

namespace App\Models\MasterData\Goods;

use App\Models\Adm\LendingFacility;
use App\Models\Adm\LendingGoods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "goods";
    protected $fillable = [
        'name',
        'category',
        'barcode',
        'file',
    ];
    public function lending_goods()
    {
        return $this->hasMany(LendingGoods::class, 'id');
    }

    public function lending_facility()
    {
        return $this->belongsTo(LendingFacility::class, 'id');
    }
}
