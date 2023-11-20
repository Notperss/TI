<?php

namespace App\Models\SystemInformation\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name_app',
        'creator',
        'date_start',
        'date_finish',
        'path_app',
        'path_database',
        'path_file',
        'description',

    ];
}
