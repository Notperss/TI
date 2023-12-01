<?php

namespace App\Models\Network\Distribution;

use App\Models\ManagementAccess\DetailUser;
use App\Models\MasterData\Location\LocationRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_room_id',
        'user_id',
        'date',
        'description',
        'file',
    ];

    public function location_room()
    {
        // 2 parameter (path model, field foreign key)
        return $this->belongsTo(LocationRoom::class, 'location_room_id');
    }

    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(DetailUser::class, 'user_id');
    }

    public function distribution_asset()
    {
        return $this->hasMany(DistributionAsset::class, 'distribution_id');
    }
}
