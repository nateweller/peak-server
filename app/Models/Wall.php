<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wall extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'name',
        'order'
    ];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'location'
    ];

    /**
     * Get the location that owns the wall.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function climbs()
    {
        return $this->hasMany(Climb::class);
    }

    public function getLocationAttribute()
    {
        return $this->location()->select(['id', 'name'])->first();
    }
}
