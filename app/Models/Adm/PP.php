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
        "stats",];

    public function pp()
    {
        return $this->hasMany(Pp_file::class, "pp_id", "id");
    }
}
