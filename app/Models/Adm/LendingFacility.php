<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendingFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_lend',
        'date_return',
        'borrower',
        'description',
        'note',
    ];
}
