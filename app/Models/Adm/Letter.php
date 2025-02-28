<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\Division\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Letter extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_id',
        'no_letter',
        'type_letter',
        'date_letter',
        'date_receipt',
        'date_sent',
        'file',
        'recipient',
        'sender',
        'description',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
