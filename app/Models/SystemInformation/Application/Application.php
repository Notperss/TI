<?php

namespace App\Models\SystemInformation\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'name_app',
        'creator',
        'date_start',
        'date_finish',
        'path_app',
        'path_database',
        'path_file',
        'description',
        'stats',
    ];

    public function app()
    {
        return $this->hasMany(ApplicationMonitoring::class, 'id');
    }
}
