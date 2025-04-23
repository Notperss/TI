<?php

namespace App\Models\Maintenance;

use App\Models\MasterData\Employee;
use App\Models\MasterData\Goods\Barang;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'user_id',
        'goods_id',
        'reporter',
        'report_number',
        'type_malfunction',
        'date',
        'file',
        'stats',
        'description',

        'asset_name',
        'barcode',
        'pic',
        'maintenance_operator',
        'category_asset',
    ];

    public function employee()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'user_id');
    }
    public function asset()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Barang::class, 'goods_id');
    }
    public function asset_barcode()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Barang::class, 'barcode');
    }
    public function maintenanceStatus()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->hasMany(MaintenanceStatus::class, 'maintenance_id');
    }
}
