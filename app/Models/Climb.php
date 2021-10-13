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

        $votesSum = 0;
        $votesTotal = 0;
        foreach ($votes as $index => $vote) {
            $votesSum = ($index + 1) * $vote->vote_count;
            $votesTotal += $vote->vote_count;
        }
        if ($votesTotal === 0) {
            return null;
        }

        $averageGradeIndex = round($votesSum / $votesTotal) - 1;
        $averageGradeId = $votes[$averageGradeIndex]->grade_id;

        $averageGrade = GradingGrade::select('id', 'name')->find($averageGradeId);
        $averageGrade->vote_count = $votesTotal;

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

