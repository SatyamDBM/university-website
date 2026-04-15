<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\Category;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    // Home Page
    public function home()
    {
        $universityCount  = User::where(['role' => 'university', 'linking_status' => 'approved'])->count();
        $courseCount  = Course::where(['status' => 'Live'])->count();
        $student_helped = Enquiry::whereNotNull('user_id')->count();

        $categories = Category::get();

        foreach ($categories as $category) {
            $category->university_count = Course::where('category_id', $category->id)
                ->whereNotNull('user_id')
                ->distinct('user_id')
                ->count('user_id');
        }

        // ✅ STEP 1: Get all live courses ONCE
        $allCourses = Course::where('status', 'Live')->get();

        // ✅ STEP 2: Group in memory (FAST)
        $grouped = $allCourses->groupBy('course_name');

        $courseData = [];

        foreach ($grouped as $name => $items) {

            // ✅ calculate unique universities from same collection (NO DB QUERY)
            $uniCount = $items->pluck('user_id')->unique()->count();

            $courseData[] = (object)[
                'course_name' => $name,
                'duration' => $items->first()->duration,
                'fees' => $items->first()->total_fees,
                'type' => $items->first()->course_type,
                'university_count' => $uniCount,
            ];
        }

        return view('website.index', compact(
            'universityCount',
            'courseCount',
            'student_helped',
            'categories',
            'courseData'
        ));
    }

    public function filterCourses(Request $request)
    {
        $level = $request->level;

        $query = Course::where('status', 'Live');

        if ($level) {
            $query->where('degree_level', $level);
        }

        $allCourses = $query->get();

        $grouped = $allCourses->groupBy('course_name');

        $courseData = [];

        foreach ($grouped as $name => $items) {

            $courseData[] = [
                'course_name' => $name,
                'duration' => $items->first()->duration,
                'fees' => $items->first()->total_fees,
                'type' => $items->first()->course_type,
                'university_count' => $items->pluck('user_id')->unique()->count(),
            ];
        }

        return response()->json($courseData);
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // check duplicate
        if (Newsletter::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'You are already subscribed!'
            ]);
        }

        Newsletter::create([
            'email' => $request->email
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscribed successfully!'
        ]);
    }

    // University Listing
    public function universities()
    {
        return view('website.university_listing');
    }

    // University Detail
    public function universityDetail()
    {
        return view('website.university_details');
    }

    // Course Listing
    public function courses()
    {
        return view('website.course_listing');
    }

    // Course Detail
    public function courseDetail()
    {
        return view('website.course_details');
    }

    // Blog Listing
    public function blog()
    {
        return view('website.blog');
    }

    // Blog Detail
    public function blogDetail()
    {
        return view('website.blog-detail');
    }

    // About Page
    public function about()
    {
        return view('website.about');
    }

    // Contact Page
    public function contact()
    {
        return view('website.contact');
    }

    // FAQ Page
    public function faq()
    {
        return view('website.faq');
    }

    // Terms & Conditions
    public function terms()
    {
        return view('website.terms-conditions');
    }

    // Privacy Policy
    public function privacy()
    {
        return view('website.privacy-policy');
    }

    // Search
    public function search(Request $request)
    {
        $course   = $request->get('course');
        $location = $request->get('location');
        $budget   = $request->get('budget');

        return view('website.search-results', compact('course', 'location', 'budget'));
    }

    public function enquiryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email:rfc,dns', 'max:150', 'unique:enquiries,email'],
            'mobile' => ['required', 'digits_between:10,10', 'regex:/^[0-9]+$/'],
            'course' => ['required', 'string', 'min:2', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        Enquiry::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Enquiry submitted successfully!'
        ]);
    }
}
