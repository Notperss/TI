<?php

namespace App\Models\Maintenance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_id',
        'users_id',
        'description',
        'date',
        'report_status',
        'file',
    ];
    public function user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'users_id');
    }
}
