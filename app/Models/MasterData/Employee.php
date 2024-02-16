<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Network\Distribution\Distribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'employee';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'nip',
        'name',
        'job_position',
        'division_id',
        'department_id',
        'section_id',
        'company',
        'type_user',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function division()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Division', 'division_id', 'id');
    }
    // one to many
    public function department()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Department', 'department_id', 'id');
    }
    // one to many
    public function section()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Section', 'section_id', 'id');
    }

    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'user_id', 'id');
    }
    public function maintenance()
    {
        return $this->hasMany(Distribution::class, 'employee_id', 'id');
    }
}
