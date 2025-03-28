<?php

namespace App\Models\Act_daily;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workcat extends Model
{
    use HasFactory, SoftDeletes;

    // protected $table = 'workcat';

    protected $guarded = 'id';

    protected $fillable = [
        'job_type',
        'description',
        'terminal_id',

    ];


    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(ActDaily::class, 'work_type_id');
    }
}
