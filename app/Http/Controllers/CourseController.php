<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
            'credits' => 'required|integer|min:1|max:10', // Assuming credits are between 1 and 10
        ]);

        Course::create($request->all());

        Session::flash('success', 'Course created successfully.');
        return redirect()->route('courses.index');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id, // Unique except for current course
            'credits' => 'required|integer|min:1|max:10',
        ]);

        $course->update($request->all());

        Session::flash('success', 'Course updated successfully.');
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Due to `onDelete('cascade')` in student_course migration,
        // associated pivot entries will be automatically deleted.
        $course->delete();

        Session::flash('success', 'Course deleted successfully.');
        return redirect()->route('courses.index');
    }
}