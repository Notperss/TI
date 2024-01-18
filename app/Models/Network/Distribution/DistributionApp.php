<?php

namespace App\Models\Network\Distribution;

use App\Models\SystemInformation\License\License;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'distribution_id',
        'license_id',
    ];

    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id');
    }
    public function app()
    {
        return $this->belongsTo(License::class, 'license_id');
    }
}
