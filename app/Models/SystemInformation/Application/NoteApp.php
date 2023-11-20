<?php

namespace App\Models\SystemInformation\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'note',
        'date',
        'file',
    ];
}