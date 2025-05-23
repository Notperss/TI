<?php

namespace App\Models\MasterData\Hardware;

use App\Models\Data\Hardware\DevicePc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hardisk extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'hardware_hardisk';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'size',
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
        return $this->hasMany(DevicePc::class, 'hardisk_id');
    }
}
