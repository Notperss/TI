<?php

namespace App\Models\MasterData\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterData\Location\LocationRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationSub extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location_sub';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'stats',
        'description',
        'location_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function location_detail()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Location\LocationSub', 'location_sub_id');
    }
    public function location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function room_location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(LocationRoom::class, 'sub_location_id', 'id');
    }
}
