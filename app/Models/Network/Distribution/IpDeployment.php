<?php

namespace App\Models\Network\Distribution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpDeployment extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribution_id',
        'ip',
        'internet_access',
        'gateway',
    ];

    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'distribution_id');
    }
}
