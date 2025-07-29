<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course')
                    ->withPivot('score') // Include the score from the pivot table
                    ->withTimestamps();
    }

    /**
     * Calculate the GPA for the student based on their enrolled courses and scores.
     *
     * @return float
     */
    public function calculateGpa()
    {
        $totalGradePoints = 0;
        $totalCredits = 0;

        foreach ($this->courses as $course) {
            $score = $course->pivot->score;
            if (is_null($score)) {
                continue; // Skip courses without a score
            }

            $gradePoints = $this->getGpaPoints($this->calculateLetterGrade($score));
            $totalGradePoints += $gradePoints * $course->credits;
            $totalCredits += $course->credits;
        }

        return $totalCredits > 0 ? $totalGradePoints / $totalCredits : 0;
    }

    /**
     * Calculate the letter grade for a given score.
     *
     * @param int $score
     * @return string
     */
    public function calculateLetterGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }

    /**
     * Get the GPA points for a given letter grade.
     *
     * @param string $grade
     * @return float
     */
    private function getGpaPoints($grade)
    {
        switch ($grade) {
            case 'A': return 4.0;
            case 'B': return 3.0;
            case 'C': return 2.0;
            case 'D': return 1.0;
            case 'F': return 0.0;
            default: return 0.0;
        }
    }
}
