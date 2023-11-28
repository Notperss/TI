<?php

namespace App\Models\Network\IpPhone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'caller',
        'type',
        'location',
        'barcode',
        'ip',
        'installation_date',
        'file',
        'description',
        'stats',
    ];
}
