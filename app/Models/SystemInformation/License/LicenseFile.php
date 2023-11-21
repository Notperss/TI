<?php

namespace App\Models\SystemInformation\License;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_id',
        'note',
        'date',
        'file',
    ];
}
