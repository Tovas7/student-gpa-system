<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // For flash messages

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        // Eager load courses for each student to calculate GPA efficiently
        $students = Student::with('courses')->get()->map(function ($student) {
            // Calculate GPA for each student and add it as a dynamic property
            $student->gpa = $student->calculateGpa();
            return $student;
        })->sortByDesc('gpa')->values(); // Sort by GPA in descending order and reset array keys

        return view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $courses = Course::all(); // Get all available courses to display in the form
        return view('students.create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'courses' => 'array',
            'courses.*.id' => 'required|exists:courses,id',
            'courses.*.score' => 'nullable|integer|min:0|max:100', // Score can be empty string, but if present, must be int
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $scores = [];
        foreach ($request->courses as $courseData) {
            // Only attach course if a score is provided (not null or empty string)
            if (isset($courseData['score']) && $courseData['score'] !== '') {
                $scores[$courseData['id']] = ['score' => (int)$courseData['score']];
            }
        }
        $student->courses()->attach($scores); // Attach courses with their scores

        Session::flash('success', 'Student created successfully.'); // Flash a success message
        return redirect()->route('students.index');
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        // Eager load courses and their pivot data (score) for the specific student
        $student->load('courses');
        $allCourses = Course::all(); // Get all available courses

        // Prepare courses data for the frontend form:
        // We want to show ALL courses, and pre-fill scores for those the student is enrolled in.
        $studentCoursesData = $allCourses->map(function ($course) use ($student) {
            $studentCourse = $student->courses->firstWhere('id', $course->id);
            return [
                'id' => $course->id,
                'name' => $course->name,
                'credits' => $course->credits,
                'score' => $studentCourse ? $studentCourse->pivot->score : null, // Null if not enrolled
            ];
        });

        return view('students.edit', [
            'student' => $student,
            'courses' => $studentCoursesData,
        ]);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id, // Unique except for current student
            'courses' => 'array',
            'courses.*.id' => 'required|exists:courses,id',
            'courses.*.score' => 'nullable|integer|min:0|max:100',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $scoresToSync = [];
        foreach ($request->courses as $courseData) {
            // Only sync if a score is provided (not null or empty string)
            // If a score is empty, it means the course is effectively "detached" or score cleared
            if (isset($courseData['score']) && $courseData['score'] !== '') {
                $scoresToSync[$courseData['id']] = ['score' => (int)$courseData['score']];
            }
        }
        // `sync` detaches courses not in the provided array and attaches/updates those that are.
        $student->courses()->sync($scoresToSync);

        Session::flash('success', 'Student updated successfully.');
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        Session::flash('success', 'Student deleted successfully.');
        return redirect()->route('students.index');
    }
}