<?php

namespace App\Models\Data\Hardware;

use App\Models\MasterData\Hardware\Hardisk;
use App\Models\MasterData\Hardware\Motherboard;
use App\Models\MasterData\Hardware\Processor;
use App\Models\MasterData\Hardware\Ram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevicePc extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'device_pc';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'motherboard_id',
        'processor_id',
        'hardisk_id',
        'ram_id',
        'no_asset',
        'file',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $with = [
        'hardisk',
        'motherboard',
        'processor',
        'ram',
    ];
    // one to many
    public function hardisk()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Hardisk::class, 'hardisk_id', 'id');
    }
    // one to many
    public function motherboard()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Motherboard::class, 'motherboard_id', 'id');
    }
    // one to many
    public function processor()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Processor::class, 'processor_id', 'id');
    }
    // one to many
    public function ram()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Ram::class, 'ram_id', 'id');
    }
}
