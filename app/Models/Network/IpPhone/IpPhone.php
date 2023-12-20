<?php

namespace App\Models\Network\IpPhone;

use App\Models\Network\Distribution\DistributionAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'caller',
        'type',
        'distributionAsset_id',
        'location',
        'barcode',
        'ip',
        'installation_date',
        'file',
        'description',
        'stats',
    ];

    public function distribution_asset()
    {
        return $this->belongsTo(DistributionAsset::class, 'distributionAsset_id', 'id');
    }

}
