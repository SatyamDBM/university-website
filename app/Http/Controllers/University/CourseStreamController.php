<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseStream;

class CourseStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streams = CourseStream::with('course')->paginate(10); // eager load courses, paginated
        return view('university.courseStream.index', compact('streams'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('university.courseStream.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255|min:3',
            'course_id'         => 'required|exists:courses,id',
            'min_fee'           => 'required|numeric|min:1|max:999999',
            'max_fee'           => 'required|numeric|gte:min_fee|max:999999',
            'duration'          => 'nullable|string|max:100',
            'seats'             => 'nullable|integer|min:1',
            'mode'              => 'nullable|string|in:Full-time,Part-time,Online',
            'min_qualification' => 'nullable|string|max:255',
            'min_percentage'    => 'nullable|string|max:10',
            'entrance_exams'    => 'nullable|string|max:255',
            'avg_package'       => 'nullable|numeric|min:1|max:999999',
            'intake'            => 'nullable|string|max:100',
            'description'       => 'nullable|string',
        ]);

        CourseStream::create($validated);

        return redirect()->route('streams.index')->with('success', 'Stream added');
    }
    public function edit($id)
    {
        $courses = Course::all();
        $stream = CourseStream::findOrFail($id);
        return view('university.courseStream.edit', compact('stream', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $stream = CourseStream::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255|min:3',
            'course_id'         => 'required|exists:courses,id',
            'min_fee'           => 'required|numeric|min:1|max:999999',
            'max_fee'           => 'required|numeric|gte:min_fee|max:999999',
            'duration'          => 'nullable|string|max:100',
            'seats'             => 'nullable|integer|min:1',
            'mode'              => 'nullable|string|in:Full-time,Part-time,Online',
            'min_qualification' => 'nullable|string|max:255',
            'min_percentage'    => 'nullable|string|max:10',
            'entrance_exams'    => 'nullable|string|max:255',
            'avg_package'       => 'nullable|numeric|min:1|max:999999',
            'intake'            => 'nullable|string|max:100',
            'description'       => 'nullable|string',
        ]);

        $stream->update($validated);

        return back()->with('success', 'Stream updated successfully');
    }
    public function destroy($id)
    {
        CourseStream::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Stream deleted successfully']);
    }
}
