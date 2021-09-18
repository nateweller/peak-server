<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Climb extends Model
{
    use softDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'name',
        'grade',
        'discipline',
        'color',
        'created_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'send_count'
    ];

    /**
     * Get the climb's sends.
     */
    public function sends() 
    {
        return $this->hasMany(ClimbSend::class);
    }

    /**
     * Get the amount of sends logged for the climb.
     * 
     * @return int
     */
    public function getSendCountAttribute() : int
    {
        return $this->sends()->count();
    }
}
