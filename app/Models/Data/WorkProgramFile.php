<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProgramFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_program_id',
        'uraian',
        'date',
        'description',
        'file',
    ];
}
