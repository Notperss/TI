<?php

namespace App\Models\Maintenance;

use App\Models\MasterData\Employee;
use App\Models\MasterData\Goods\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
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
    ];

    public function employee()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function asset()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(Barang::class, 'goods_id');
    }
    public function maintenanceStatus()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->hasMany(MaintenanceStatus::class, 'id', 'maintenance_id');
    }
}
