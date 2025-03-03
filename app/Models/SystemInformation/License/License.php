<?php

namespace App\Models\SystemInformation\License;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_app',
        'type_app',
        'product',
        'name_vendor',
        'version',
        'date_start',
        'date_finish',
        'pp',
        'barcode',
        'num_of_licenses',
        'stats',
        'description',
    ];
}
