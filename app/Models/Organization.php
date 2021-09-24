<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Location;

class Organization extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'name' 
    ];

    /**
     * The user that owns the organization.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the locations for the organization.
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get the grading systems used by the organization.
     */
    public function gradingSystems()
    {
        return $this->hasMany(GradingSystem::class);
    }
}
