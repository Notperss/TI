<?php

namespace App\Models;

use App\Models\ManagementAccess\DetailUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'category',
        'start_date',
        'finish_date',
        'description',
        'stats',
        'file',
    ];

    public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    // one to many
    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo(DetailUser::class, 'users_id', 'id');
    }

}
