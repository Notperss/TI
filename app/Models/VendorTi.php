<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorTi extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'vendor_ti';
    protected $fillable = ['nama_vendor', 'telp', 'pic', 'address', 'status'];
}
