<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\Division\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormTi extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_id',
        'sender',
        'type_form',
        'file',
        'date_form',
        'stats',
        'description',
    ];

    public function form()
    {
        return $this->hasMany(Form::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
