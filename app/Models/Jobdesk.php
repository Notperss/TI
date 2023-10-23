<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobdesk extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    // public $table = 'work_program';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'jobdesk',
        'year',
        'general',
        'technical',
        'description',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
