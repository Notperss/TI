<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pp_file extends Model
{

    use HasFactory;

    protected $fillable = [
        "pp_id",
        "name_file",
        "type_file",
        "file",
        "description_file",
    ];

    public function pp()
    {
        return $this->belongsTo(PP::class, "id");
    }
}
