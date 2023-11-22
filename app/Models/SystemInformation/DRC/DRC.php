<?php

namespace App\Models\SystemInformation\DRC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DRC extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'path_source',
        'path_backup',
        'path_drc',
        'backup_frequency',
        'backup_time',
        'stats',
        'description',
    ];

    public function drc()
    {
        return $this->hasMany(DRCMonitoring::class, 'id');
    }
}
