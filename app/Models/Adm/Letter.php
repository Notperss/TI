<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_letter',
        'type_letter',
        'date_letter',
        'date_receipt',
        'date_sent',
        'file',
        'recipient',
        'sender',
        'description',
    ];
}
