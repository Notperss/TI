<?php

namespace App\Models\MasterData\Network;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cctv extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'network_cctv';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'km',
        'latitude',
        'longitude',
        'link_cctv',
        'logo',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
