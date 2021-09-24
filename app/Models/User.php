<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\User;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The organizations that belong to the user.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    /**
     * The locations that belong to organizations that belong to the user.
     */
    public function locations()
    {
        return $this->hasManyThrough(Organization::class, Group::class);
    }

    /**
     * The climbs that belong to the user.
     */
    public function climbs()
    {
        return $this->hasMany(Climb::class);
    }

    /**
     * The climb sends logged by the user.
     */
    public function sends()
    {
        return $this->hasMany(ClimbSend::class);
    }
}
