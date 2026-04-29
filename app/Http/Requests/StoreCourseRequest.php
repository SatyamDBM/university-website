<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // ================= BASIC INFO =================
            'course_name' => 'required|string|min:3|max:255',

            'category_id' => 'required|exists:categories,id',

            'course_type' => 'required|in:Full-time,Part-time,Online',

            'duration' => 'required|string|max:100', // e.g. "3 Years", "6 Months"

            'mode' => 'required|in:Offline,Hybrid,Online',

            'admission_status' => 'required|in:Open,Closed',

            'description' => 'required|string|min:20|max:5000',


            // ================= FEES =================
            'tuition_fees' => 'required|numeric|min:0|max:10000000',

            'hostel_fees' => 'nullable|numeric|min:0|max:10000000',

            'admission_fees' => 'required|numeric|min:0|max:10000000',

            'total_fees' => 'nullable|numeric|min:0|max:10000000', // computed


            // ================= ADMISSION INFO =================
            'seat_availability' => 'required|integer|min:1|max:10000',

            'age_limit' => 'nullable|string|max:50', // e.g. "17-25"


            // ================= ELIGIBILITY =================
            'min_qualification' => 'required|string|max:255',

            'min_percentage' => 'required|numeric|min:50|max:100',

            'required_exams' => 'nullable|string|max:255',


            // ================= FILE =================
            'curriculum_file' => 'nullable|file|mimes:pdf|max:5120',

            'curriculum_text' => 'nullable|string',


            // ================= SEAT DISTRIBUTION =================
            'seat_category' => 'required|array|min:1',

            'seat_category.*' => 'required|string|max:100',

            'seat_count' => 'required|array|min:1',

            'seat_count.*' => 'required|integer|min:1|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'course_name.required' => 'Course name is required.',
            'course_name.min' => 'Course name must be at least 3 characters.',

            'category_id.required' => 'Please select a category.',

            'tuition_fees.min' => 'Tuition fees cannot be negative.',

            'seat_count.*.min' => 'Seat count must be at least 1.',

            'min_percentage.max' => 'Percentage cannot exceed 100.',
        ];
    }
}
