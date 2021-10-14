<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        'user_id',
        'grade_id',
        'color_id',
        'name',
        'discipline',
        'created_at'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'color',
        'grade',
        'send_count',
        'community_grade',
        'average_rating'
    ];

    /**
     * Get the climb's owner.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the climb's grade.
     */
    public function grade()
    {
        return $this->belongsTo(GradingGrade::class, 'grade_id');
    }

    /**
     * Get the climb's hold color.
     */
    public function climbColor()
    {
        return $this->belongsTo(ClimbColor::class, 'color_id');
    }

    /**
     * Get the climb's sends.
     */
    public function sends() 
    {
        return $this->hasMany(ClimbSend::class);
    }

    /**
     * Get color attribute.
     * 
     * @return ClimbColor
     */
    public function getColorAttribute() : ?ClimbColor 
    {
        return $this->climbColor()->select(['id', 'name', 'color'])->first();
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

    /**
     * Get the grade of the climb.
     */
    public function getGradeAttribute()
    {
        return $this->grade()->select(['id', 'name'])->first();
    }

    /**
     * Get the average grade from user sends.
     * 
     * @return \App\Models\GradingGrade
     */
    public function getCommunityGradeAttribute() : ?GradingGrade
    {
        $votes = DB::table('climb_sends')
                        ->selectRaw('count(climb_sends.grade_id) as vote_count, climb_sends.grade_id, grading_grades.order')
                        ->leftJoin('grading_grades', 'climb_sends.grade_id', '=', 'grading_grades.id')
                        ->where('climb_id', $this->id)
                        ->whereNotNull('grade_id')
                        ->groupBy('grade_id')
                        ->orderBy('grading_grades.order')
                        ->get();

        /**
         * @todo This calculation depends on the "order" attribute of grades to 
         *       be perfectly saved. While I would like that to always be true,
         *       it doesn't feel great writing code that relies on that...
         */
        $sum = 0;
        $count = 0;
        foreach ($votes as $vote) {
            $sum += $vote->order * $vote->vote_count;
            $count += $vote->vote_count;
        }
        if ($count === 0) {
            return null;
        } 

        $averageOrder = ceil($sum / $count);

        $averageGrade = GradingGrade::select('id', 'name')->where('order', $averageOrder)->first();
        $averageGrade->vote_count = $count;

        if (! $averageGrade) {
            return null;
        }

        return $averageGrade;
    }

    public function getAverageRatingAttribute() 
    {
        return (int) $this->sends()->avg('rating');

        return $ratings;
    }
}

