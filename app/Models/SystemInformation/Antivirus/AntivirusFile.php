<?php

namespace App\Models\SystemInformation\Antivirus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntivirusFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'antivirus_id',
        'note',
        'date',
        'file',
    ];
}
