<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingSystem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'name',
        'discipline'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'grades'
    ];

    /**
     * The organization that uses this grading system.
     */
    public function organization() 
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * The grades used by this grading system.
     */
    public function grades()
    {
        return $this->hasMany(GradingGrade::class);
    }

    /**
     * Get the grades used by this grading system.
     */
    public function getGradesAttribute()
    {
        return $this->grades()->select(['id', 'name'])->orderBy('order', 'asc')->get();
    }
}
