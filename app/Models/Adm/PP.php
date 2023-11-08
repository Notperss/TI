<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PP extends Model
{
    use HasFactory;

    protected $table = "pps";
    protected $fillable = [
        "no_pp",
        "year",
        "date",
        "job_name",
        "job_value",
        "description",
        "rkap",
        "stats",
        "type_bill",
    ];

    public function pp_file()
    {
        return $this->hasMany(Pp_file::class, "pp_id", "id");
    }
    public function bill()
    {
        return $this->hasMany(Bill::class, "pp_id", "id");
    }


}
