<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATK extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'file',
        'date',
        'usage',
    ];
}
