<?php

namespace App\Models\Data\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceMonitor extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_monitor';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'monitor_id',
        'no_asset',
        'file',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function monitor()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Hardware\Monitor', 'monitor_id', 'id');
    }
}
