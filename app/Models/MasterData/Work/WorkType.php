<?php

namespace App\Models\MasterData\Work;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkType extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'work_type';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'section',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\DailyActivity', 'work_type_id');
    }
}
