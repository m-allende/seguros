<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'phone',
        'website',
        'birthday',
        'address_laboral',
        'phone_laboral_1',
        'phone_laboral_2',
        'email_laboral_1',
        'email_laboral_2',
        'region_id',
        'commune_id',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications()
    {
        return $this->morphMany(Notification::class, "parent");
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, "parent");
    }

    public function lastPhoto()
    {
        return $this->morphOne(Photo::class, "parent")->latestOfMany();
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

}
