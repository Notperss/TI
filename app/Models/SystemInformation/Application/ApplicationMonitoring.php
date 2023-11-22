<?php

namespace App\Models\SystemInformation\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationMonitoring extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',

    ];

    public function app_monitoring()
    {
        return $this->belongsTo(Application::class, 'id');
    }
}
