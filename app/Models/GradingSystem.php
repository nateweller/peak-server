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
     * The organization that uses this grading system.
     */
    public function organization() 
    {
        return $this->belongsTo(Organization::class);
    }
}
