<?php

namespace App\Models\MasterData\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Software extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'software';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'software_name',
        'software_category',
        'software_type',
        'variant',
        'serial_number',
        'license_amount',
        'start_license',
        'finish_license',
        'no_pp',
        'license_type',
        'purchase_year',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
