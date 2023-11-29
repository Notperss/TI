<?php

namespace App\Models\MasterData\Hardware;

use App\Models\Masterdata\Goods\GoodsProcessor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processor extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'hardware_processor';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DevicePC', 'processor_id');
    }

    public function goods_processor()
    {
        return $this->hasMany(GoodsProcessor::class, 'processor_id');
    }
}
