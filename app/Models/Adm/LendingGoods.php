<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendingGoods extends Model
{
    use HasFactory;

    protected $fillable = [
        'lendingfacility_id',
        'name',
        'category',
        'barcode',
        'file',
    ];


    public function lending_facility()
    {
        return $this->belongsTo(LendingFacility::class, 'id');
    }
    public function pp()
    {
        return $this->belongsTo(PP::class, "id");
    }
}
