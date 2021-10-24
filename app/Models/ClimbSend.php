<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClimbSend extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'climb_id',
        'user_id',
        'grade_id',
        'rating',
        'feedback'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'climb_id',
        'user_id',
        'grade_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'climb',
        'user',
        'grade'
    ];

    /**
     * Get the climb.
     */
    public function climb()
    {
        return $this->belongsTo(Climb::class);
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the grade.
     */
    public function grade()
    {
        return $this->belongsTo(GradingGrade::class);
    }

    public function getClimbAttribute()
    {
        return $this->climb()->first();
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getGradeAttribute()
    {
        return $this->grade()->first();
    }
}
