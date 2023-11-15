<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_form',
        'file',
        'description',
    ];

    public function form_ti()
    {
        return $this->belongsTo(FormTi::class);
    }
}
