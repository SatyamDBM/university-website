<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('university_id', Auth::user()->university_id ?? null)
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = Category::where('status', 'active')->get(); // Adjust if you have a parent/child structure
        return view('university.courses.create', compact('categories', 'subcategories'));
    }

    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['course_name']) . '-' . uniqid();
        $user = auth()->user();
        if (!$user || !$user->university_id) {
            return redirect()->back()->withErrors(['You must be linked to a university to create a course.']);
        }
        $data['university_id'] = $user->university_id;
        $data['status'] = $request->input('save_as_draft') ? 'Draft' : 'Pending';
        if ($request->hasFile('curriculum_file')) {
            $data['curriculum_file'] = $request->file('curriculum_file')->store('curriculums', 'public');
        }
        $course = Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Course saved successfully!');
    }

    public function show(Course $course)
    {
        return view('university.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = Category::where('status', 'active')->get(); // Adjust if you have a parent/child structure
        return view('university.courses.edit', compact('course', 'categories', 'subcategories'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        if ($request->hasFile('curriculum_file')) {
            $data['curriculum_file'] = $request->file('curriculum_file')->store('curriculums', 'public');
        }
        // If course is live and edited, set to Pending
        if ($course->status === 'Live') {
            $data['status'] = 'Pending';
        }
        $course->update($data);
        return response()->json(['success' => true, 'message' => 'Course updated successfully', 'redirect' => route('courses.index')]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['success' => true, 'message' => 'Course deleted successfully']);
    }

    // Admin approval
    public function approve(Course $course)
    {
        $course->update(['status' => 'Live', 'admin_feedback' => null]);
        // Notify university (event/notification)
        return response()->json(['success' => true, 'message' => 'Course approved']);
    }

    public function reject(Request $request, Course $course)
    {
        $request->validate(['admin_feedback' => 'required|string']);
        $course->update(['status' => 'Rejected', 'admin_feedback' => $request->admin_feedback]);
        // Notify university (event/notification)
        return response()->json(['success' => true, 'message' => 'Course rejected']);
    }
}
