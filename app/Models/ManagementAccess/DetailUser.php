<?php

namespace App\Models\ManagementAccess;

use App\Models\Act_daily\ActDaily;
use App\Models\Adm\PP;
use App\Models\Attendance;
use App\Models\Network\Distribution\Distribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class DetailUser extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'detail_user';
    protected $primarykey = 'id';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'user_id',
        'type_user_id',
        'nik',
        'job_position',
        'status',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function type_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\ManagementAccess\TypeUser', 'type_user_id', 'id');
    }

    public function user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function daily_activityy()
    // {
    //     // 2 parameter (path model, field foreign key)
    //     return $this->hasOne('App\Models\Data\DailyActivity', 'executor');
    // }
    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasOne(ActDaily::class, 'executor');
    }
    public function pp()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasOne(PP::class, 'user_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'users_id', 'id');
    }
    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'user_id', 'id');
    }
}
