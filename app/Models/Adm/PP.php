<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Model;
use App\Models\ManagementAccess\DetailUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PP extends Model
{
    use HasFactory;

    protected $table = "pps";
    protected $fillable = [
        "user_id",
        "no_pp",
        "year",
        "date",
        "job_name",
        "job_value",
        "contract_value",
        "description",
        "rkap",
        "stats",
        "type_bill",
    ];

    public function pp_file()
    {
        return $this->hasMany(Pp_file::class, "pp_id", "id");
    }
    public function pp_status()
    {
        return $this->hasMany(Pp_status::class, "pp_id", "id");
    }
    public function bill()
    {
        return $this->hasMany(Bill::class, "pp_id", "id");
    }
    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(DetailUser::class, 'user_id', 'id');
    }


}
