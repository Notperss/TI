<?php

namespace App\Models\Adm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_demand',
        'type_demand',
        'date_demand',
        'date_pj',
        'nominal',
        'accountability',
        'description',
        'file',
        'file_pj',
        'nominal_pj',];
}
