<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTi extends Model
{
    use HasFactory;
    // protected $table = 'vendor_ti';
    protected $fillable = ['nama_vendor', 'telp', 'pic', 'address', 'status'];
}
