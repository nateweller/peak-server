<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingGrade extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grading_system_id',
        'name',
        'order'
    ];

    /**
     * The grading system this grade is part of.
     */
    public function gradingSystem() 
    {
        return $this->belongsTo(GradingSystem::class);
    }

    /**
     * Climbs using the grade.
     */
    public function climbs()
    {
        return $this->hasMany(Climb::class);
    }

    /**
     * Sends using the grade.
     */
    public function sends()
    {
        return $this->hasMany(ClimbSends::class);
    }
}
