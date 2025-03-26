<?php

namespace App\Models\Network\Distribution;

use App\Models\Inspection\Inspection;
use App\Models\MasterData\Goods\Barang;
use App\Models\Network\IpPhone\IpPhone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributionAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'distribution_id',
        'asset_id',
        'stats',
    ];

    public function asset()
    {
        return $this->belongsTo(Barang::class, 'asset_id', 'id');
    }
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id', 'id');
    }

    public function user_distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id', 'asset_id');
    }
    public function ip_deployment()
    {
        return $this->belongsTo(IpDeployment::class, 'distribution_id');
    }
    public function ip_phone()
    {
        return $this->belongsTo(IpPhone::class, 'distributionAsset_id');
    }
    // public function inspections()
    // {
    //     return $this->belongsToMany(Inspection::class, 'asset_inspection');
    // }


}
