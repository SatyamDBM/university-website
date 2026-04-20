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
use Illuminate\Support\Facades\DB;
use App\Models\CmsPage;
use App\Models\AdminFaq;
use App\Models\ContactUs;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\University;
use App\Models\UniversityOverview;
use Carbon\Carbon;


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
        $universities = University::where('is_verified', 0)->get();
        return view('website.university_listing', compact('universities'));
    }

    // University Detail
    public function universityDetail($id)
    {
        $university_details = University::with([
            'placements.recruiters',
            'facilities.images'
        ])->findOrFail($id);
        $overview = UniversityOverview::where('university_id', $id)->first();
        $courses = Course::with('university', 'streams')->where('university_id', $id)->where('status', 'Live')->get();
        return view('website.university_details', compact('university_details', 'overview', 'courses'));
    }

    // Course Listing
    public function courses()
    {
        $categories = Category::with(['courses.streams'])
            ->whereHas('courses', function ($q) {
                $q->where('status', 'Live');
            })
            ->get();

        return view('website.course_listing', compact('categories'));
    }
    // Course Detail
    public function courseDetail($slug)
    {
        $course = Course::with([
            'university',
            'streams',
            'admissionProcess.dates',
            'admissionProcess.steps',
            'seats',
            'university.faqs',
            'university.recruiters'
        ])
            ->where('slug', $slug)
            ->where('status', 'Live')
            ->firstOrFail();

        $cutoffs = DB::table('admission_cutoffs')
            ->where('course_id', $course->id)
            ->orderBy('round')
            ->get()
            ->groupBy('round');

        $currentYear = now()->year;

        $years = [
            $currentYear - 2,
            $currentYear - 1,
            $currentYear
        ];

        $curriculum = [];

        if (!empty($course->curriculum_text)) {
            $decoded = json_decode($course->curriculum_text, true);
            $curriculum = is_array($decoded) ? $decoded : [];
        }

        // ✅ ADD THIS
        $placement = \App\Models\Placement::with('recruiters')
            ->where('university_id', $course->university_id)
            ->first();

        return view('website.course_details', compact(
            'course',
            'cutoffs',
            'years',
            'curriculum',
            'placement'
        ));
    }

    public function blog()
    {
        $blogs = Blog::where('status', 'published')
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('publish_type', 'instant')
                    ->orWhere(function ($q) {
                        $q->where('publish_type', 'scheduled')
                            ->where('publish_date', '<=', Carbon::now());
                    });
            })
            ->latest()
            ->get();

        return view('website.blog', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::with('detail')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where(function ($query) {
                $query->where('publish_type', 'instant')
                    ->orWhere(function ($q) {
                        $q->where('publish_type', 'scheduled')
                            ->where('publish_date', '<=', Carbon::now());
                    });
            })
            ->firstOrFail();

        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->where(function ($query) {
                $query->where('publish_type', 'instant')
                    ->orWhere(function ($q) {
                        $q->where('publish_type', 'scheduled')
                            ->where('publish_date', '<=', Carbon::now());
                    });
            })
            ->latest()
            ->take(5)
            ->get();

        return view('website.blog-detail', compact('blog', 'recentBlogs'));
    }

    public function about()
    {
        $aboutUs = AboutUs::with('leadershipTeamMembers')->first();

        return view('website.about', compact('aboutUs'));
    }

    public function contact()
    {
        $contactUs = ContactUs::with('regionalOffices')->first();

        return view('website.contact', compact('contactUs'));
    }
    public function faq()
    {
        $faqs = AdminFaq::where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('website.faq', compact('faqs'));
    }

    public function terms()
    {
        $termsPage = CmsPage::where('slug', 'terms-and-conditions')
            ->where('is_active', 1)
            ->first();

        return view('website.terms-conditions', compact('termsPage'));
    }

    public function privacy()
    {
        $privacyPage = CmsPage::where('slug', 'privacy-policy')
            ->where('is_active', 1)
            ->first();

        if ($privacyPage) {
            $privacyPage->content = html_entity_decode(html_entity_decode($privacyPage->content));
        }

        return view('website.privacy-policy', compact('privacyPage'));
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
            'email' => ['required', 'email:rfc,dns', 'max:150'],
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
