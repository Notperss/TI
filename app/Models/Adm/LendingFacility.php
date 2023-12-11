<?php

namespace App\Models\Adm;

use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LendingFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_lend',
        'date_return',
        'borrower',
        'description',
        'note',
        'stats',
    ];

    public function lending_good()
    {
        return $this->hasMany(LendingGoods::class, 'lendingfacility_id', 'id');
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id');
    }

}
