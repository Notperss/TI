<?php

namespace App\Models\MasterData\Division;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'division';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'kode',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function department()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Division\Department', 'division_id');
    }
    // one to many
    public function section()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Division\Section', 'division_id');
    }
    // one to many
    public function employee()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Employee', 'division_id');
    }
}
