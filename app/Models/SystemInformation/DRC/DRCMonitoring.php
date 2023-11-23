<?php

namespace App\Models\SystemInformation\DRC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DRCMonitoring extends Model
{
    use HasFactory;
    protected $fillable = ['drc_id',];

    public function drc_monitoring()
    {
        return $this->belongsTo(DRC::class, 'drc_id', 'id');
    }
}
