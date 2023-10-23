<?php

namespace App\Models\MasterData\Software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftwareFile extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'software_file';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'software_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
