<?php

namespace App\Models\Network\Cctv;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'brand',
        'location',
        'maintainer',
        'barcode',
        'category',
        'type_cctv',
        'ip',
        'link',
        'username_cctv',
        'password_cctv',
        'lon_lat',
        'installation_date',
        'file',
        'description',
        'stats',
    ];
}
