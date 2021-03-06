<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimbColor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color'
    ];

    /**
     * Get the climbs using this hold color.
     */
    public function climbs() {
        return $this->hasMany(Climb::class);
    }
}
