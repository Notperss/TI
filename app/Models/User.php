<?php

namespace App\Models;

use App\Models\ManagementAccess\JobPosition;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Act_daily\ActDaily;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\ManagementAccess\DetailUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'icon',
        'nik',
        'name',
        'email',
        'job_position_id',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function detail_user()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasOne(DetailUser::class, 'user_id');
    }
    // one to many
    public function daily_activityy()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\DailyActivity', 'users_id');
    }

    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(ActDaily::class, 'users_id');
    }
    public function daily_exe()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany(ActDaily::class, 'executor');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'users_id');
    }
    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }
}
