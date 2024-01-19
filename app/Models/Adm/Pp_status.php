<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pp_status extends Model
{
    use HasFactory;

    protected $fillable = [
        'pp_id',
        'type_status',
        'date',
        'description',
        'file',
    ];

    public function pp()
    {
        return $this->belongsTo(PP::class, "id");
    }
}
