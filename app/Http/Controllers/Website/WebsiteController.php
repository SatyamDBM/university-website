<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // Home Page
    public function home()
    {
        return view('website.index');
    }

    // University Listing
    public function universities()
    {
        return view('website.university_listing');
    }

    // University Detail
    public function universityDetail($slug)
    {
        return view('website.university_details');
    }

    // Course Listing
    public function courses()
    {
        return view('website.course_listing');
    }

    // Course Detail
    public function courseDetail($slug)
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
}
