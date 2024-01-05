<?php

namespace App\Models\Act_daily;

use App\Models\ManagementAccess\DetailUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActDaily extends Model
{
    use HasFactory;

    // public $table = 'act_daily';

    protected $fillable = [
        'executor',
        'users_id',
        'start_date',
        'finish_date',
        'work_type_id',
        'location_room_id',
        'activity',
        'description',
        'status',
        'terminal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = [
        'users',
        'detail_user',
        'work_type',
        'location_room',
    ];

    // one to many
    public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    // public function users_executor()
    // {
    //     // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
    //     return $this->belongsTo(User::class, 'executor', 'id');
    // }
    // one to many
    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(DetailUser::class, 'executor', 'id');
    }
    // one to many
    //  public function work_category()
    //  {
    //      // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
    //      return $this->belongsTo('App\Models\MasterData\Work\WorkCategory', 'work_category_id', 'id');
    //  }
    // one to many
    public function work_type()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Workcat::class, 'work_type_id', 'id');
    }
    // one to many
    public function location_room()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\LocationRoom', 'location_room_id', 'id');
    }
}
