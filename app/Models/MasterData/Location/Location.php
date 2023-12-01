<?php

namespace App\Models\MasterData\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterData\Location\LocationRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function location_detail()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Location\Location', 'location_id');
    }

    public function sub_location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(LocationSub::class, 'location_id', 'id');
    }
    public function room_location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(LocationRoom::class, 'location_id', 'id');
    }

}
