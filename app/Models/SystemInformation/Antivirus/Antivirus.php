<?php

namespace App\Models\SystemInformation\Antivirus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antivirus extends Model
{
    use HasFactory;

    protected $table = 'antivirus';
    protected $fillable = [
        'name_antivirus',
        'year',
        'num_of_licenses',
        'date_start',
        'date_finish',
        'stats',
        'description',
    ];
}
