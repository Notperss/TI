<?php

namespace App\Models\SystemInformation\TPT;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPT extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'date',
        'file',
    ];
}
