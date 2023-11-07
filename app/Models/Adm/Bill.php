<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['pp_id', 'bill_to', 'bill_value', 'date', 'description', 'file',];

    public function pp()
    {
        return $this->belongsTo(PP::class, 'id');
    }
}
