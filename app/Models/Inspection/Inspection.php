<?php

namespace App\Models\Inspection;

use App\Models\ManagementAccess\JobPosition;
use App\Models\MasterData\Goods\Barang;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\MasterData\Location\LocationSub;
use App\Models\Network\Distribution\DistributionAsset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'job_position_id',
        'location_id',
        'sub_location_id',
        'location_room_id',
        'shift',
        'date_inspection',
        'description',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function locationSub()
    {
        return $this->belongsTo(LocationSub::class, 'sub_location_id');
    }
    public function locationRoom()
    {
        return $this->belongsTo(LocationRoom::class, 'location_room_id');
    }
    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }
    public function assets()
    {
        return $this->belongsToMany(Barang::class, 'asset_inspection', 'inspection_id', 'asset_id')
            ->withPivot('file_path');
    }

    public function indicators()
    {
        return $this->hasMany(InspectionIndicatorAsset::class);
    }

    public function testings()
    {
        return $this->hasMany(InspectionTestingAsset::class);
    }
}
