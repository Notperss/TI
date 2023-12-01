<?php

namespace App\Models\MasterData\Location;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\Location\Location;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterData\Location\LocationSub;
use App\Models\Network\Distribution\Distribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationRoom extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location_room';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'location_id',
        'sub_location_id',
        'description',
        'stats',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function location_detail()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Location\LocationRoom', 'location_room_id');
    }
    // one to many
    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\DailyActivity', 'location_room_id');
    }
    public function location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function sub_location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(LocationSub::class, 'sub_location_id');
    }

    public function distribution()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(Distribution::class, 'location_room_id', 'id');
    }
}
