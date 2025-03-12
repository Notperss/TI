<?php

namespace App\Models\Network\Distribution;

use App\Models\ManagementAccess\JobPosition;
use App\Models\User;
use App\Models\MasterData\Employee;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManagementAccess\DetailUser;
use App\Models\MasterData\Location\Location;
use App\Models\MasterData\Location\LocationRoom;
use App\Models\MasterData\Location\LocationSub;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_position_id',
        'location_id',
        'sub_location_id',
        'location_room_id',
        'user_id',
        'division',
        'date',
        'description',
        'file',
    ];

    public function location_room()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(LocationRoom::class, 'location_room_id');
    }
    public function sub_location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(LocationSub::class, 'sub_location_id');
    }
    public function location()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function job_position()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(DetailUser::class, 'user_id');
    }
    public function user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'user_id');
    }

    public function distribution_asset()
    {
        return $this->hasMany(DistributionAsset::class, 'distribution_id');
    }
    public function asset()
    {
        return $this->hasMany(Barang::class, 'id');
    }
    public function ip_deployment()
    {
        return $this->belongsTo(IpDeployment::class, 'id');
    }
    public function app()
    {
        return $this->hasMany(DistributionApp::class, 'id');
    }
    public function employee()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Employee::class, 'user_id');
    }
}
