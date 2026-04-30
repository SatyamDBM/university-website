<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseSeat;
use Illuminate\Support\Facades\DB;



class CourseController extends Controller
{
    public function index(Request $request)
    {
        $universityId = Auth::user()->university_id;
        $query = Course::where('university_id', $universityId);

        // 🔥 ALWAYS handle AJAX (even empty search)
        if ($request->ajax()) {
            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('course_name', 'like', "%{$request->search}%")
                        ->orWhere('course_type', 'like', "%{$request->search}%")
                        ->orWhere('mode', 'like', "%{$request->search}%");
                });
            }

            $courses = $query->latest()->paginate(15);

            return view('university.courses.partials.table_body', compact('courses'))->render();
        }

        // NORMAL LOAD
        $courses = $query->latest()->paginate(15);

        return view('university.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = Category::where('status', 'active')->get(); // Adjust if you have a parent/child structure
        return view('university.courses.create', compact('categories', 'subcategories'));
    }

    // public function store(StoreCourseRequest $request)
    // {
    //     $data = $request->validated();
    //     $data['slug'] = Str::slug($data['course_name']) . '-' . uniqid();
    //     $user = auth()->user();
    //     if (!$user || !$user->university_id) {
    //         return redirect()->back()->withErrors(['You must be linked to a university to create a course.']);
    //     }
    //     $data['university_id'] = $user->university_id;
    //     $data['user_id'] = $user->id;
    //     $data['status'] = $request->input('save_as_draft') ? 'Draft' : 'Pending';
    //     if ($request->hasFile('curriculum_file')) {
    //         $data['curriculum_file'] = $request->file('curriculum_file')->store('curriculums', 'public');
    //     }
    //     $course = Course::create($data);
    //     return redirect()->route('university.courses.index')->with('success', 'Course saved successfully!');
    // }
    public function store(StoreCourseRequest $request)
    {
        // dd($request->all());

        $user = auth()->user();
        if (!$user || !$user->university_id) {
            return redirect()->back()
                ->withErrors(['error' => 'You must be linked to a university to create a course.']);
        }

        $data = $request->validated();

        $data['slug']          = Str::slug($data['course_name']) . '-' . uniqid();
        $data['university_id'] = $user->university_id;
        $data['user_id']       = $user->id;
        $data['status']        = $request->input('save_as_draft') ? 'Draft' : 'Pending';

        // Compute total_fees server-side (never trust readonly JS-calculated field)
        $data['total_fees'] = ($data['tuition_fees'] ?? 0)
            + ($data['hostel_fees']   ?? 0)
            + ($data['admission_fees'] ?? 0);

        // Upload curriculum PDF
        if ($request->hasFile('curriculum_file')) {
            $data['curriculum_file'] = $request->file('curriculum_file')
                ->store('curriculums', 'public');
        }

        // Save curriculum JSON
        if (!empty($request->curriculum_text)) {
            $curriculum = json_decode($request->curriculum_text, true);
            $data['curriculum_text'] = is_array($curriculum)
                ? json_encode($curriculum)
                : null;
        }

        // Remove fields not in courses table
        unset($data['seat_category'], $data['seat_count']);

        // Create course
        $course = Course::create($data);

        // Save seat distribution
        $categories = $request->input('seat_category', []);
        $counts     = $request->input('seat_count', []);

        foreach ($categories as $index => $category) {
            if (!empty($category) && !empty($counts[$index])) {
                CourseSeat::create([
                    'course_id' => $course->id,
                    'category'  => $category,
                    'seats'     => $counts[$index],
                ]);
            }
        }

        return redirect()
            ->route('university.courses.index')
            ->with('success', 'Course saved successfully!');
    }

    public function show(Course $course)
    {
        $course->load(['category', 'seats']);

        return view('university.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = Category::where('status', 'active')->get(); // Adjust if you have a parent/child structure
        return view('university.courses.edit', compact('course', 'categories', 'subcategories'));
    }

    // public function update(UpdateCourseRequest $request, Course $course)
    // {
    //     $data = $request->validated();
    //     if ($request->hasFile('curriculum_file')) {
    //         $data['curriculum_file'] = $request->file('curriculum_file')->store('curriculums', 'public');
    //     }
    //     // If course is live and edited, set to Pending
    //     if ($course->status === 'Live') {
    //         $data['status'] = 'Pending';
    //     }
    //     $course->update($data);
    //     return response()->json(['success' => true, 'message' => 'Course updated successfully', 'redirect' => route('university.courses.index')]);
    // }
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {

            // ================= FILE UPLOAD =================
            if ($request->hasFile('curriculum_file')) {
                $data['curriculum_file'] = $request->file('curriculum_file')
                    ->store('curriculums', 'public');
            }

            // ================= STATUS LOGIC =================
            if ($course->status === 'Live') {
                $data['status'] = 'Pending';
            }

            // ================= UPDATE COURSE =================
            $course->update($data);

            // ================= SEATS UPDATE =================
            if ($request->filled('seat_category')) {

                $course->seats()->delete();

                foreach ($request->seat_category as $i => $category) {

                    $seats = $request->seat_count[$i] ?? null;

                    if (!empty($category) && $seats !== null) {
                        $course->seats()->create([
                            'category' => $category,
                            'seats'    => $seats,
                        ]);
                    }
                }
            }

            DB::commit();

            // ✅ RETURN JSON INSTEAD OF REDIRECT
            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully',
                'redirect' => route('university.courses.index')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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



    public function toggleStatus(Request $request, Course $course)
    {
        if ($request->action === 'draft' && $course->status === 'Live') {
            $course->update(['status' => 'Draft']);
        } elseif ($request->action === 'pending' && $course->status === 'Draft') {
            $course->update(['status' => 'Pending']);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
