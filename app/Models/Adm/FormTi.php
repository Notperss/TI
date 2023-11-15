<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTi extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_form',
        'type_form',
        'file',
        'date_form',
        'description',
    ];

    public function form()
    {
        return $this->hasMany(Form::class);
    }
}
