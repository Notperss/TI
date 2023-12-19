<?php

namespace App\Models\Network\Distribution;

use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributionAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'distribution_id',
        'asset_id',
    ];

    public function asset()
    {
        return $this->belongsTo(Barang::class, 'asset_id', 'id');
    }
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id', 'id');
    }
    public function ip_deployment()
    {
        return $this->belongsTo(IpDeployment::class, 'distribution_id');
    }

}
