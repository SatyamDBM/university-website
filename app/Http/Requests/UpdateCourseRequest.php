<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // ================= BASIC INFO =================
            'course_name'      => 'required|string|max:255|min:3',
            'category_id'      => 'required|exists:categories,id',
            'subcategory_id'   => 'nullable|exists:categories,id',
            'description'      => 'required|string|min:10',

            // ================= COURSE DETAILS =================
            'duration'         => 'required|string|max:100',
            'course_type'      => 'required|in:Full-time,Part-time,Online',
            'mode'             => 'required|in:Offline,Hybrid,Online',
            'admission_status' => 'required|in:Open,Closed',

            // ================= FEES =================
            'tuition_fees'     => 'required|numeric|min:0',
            'hostel_fees'      => 'nullable|numeric|min:0',
            'admission_fees'   => 'required|numeric|min:0',
            'total_fees'       => 'required|numeric|min:0',

            // ================= ELIGIBILITY =================
            'min_qualification' => 'required|string|max:255',
            'min_percentage'    => 'required|numeric|min:0|max:100',
            'required_exams'    => 'nullable|string|max:255',
            'age_limit'         => 'nullable|string|max:100',

            // ================= SEATS =================
            'seat_availability' => 'nullable|integer|min:0',

            // ================= CURRICULUM =================
            'curriculum_file'   => 'nullable|file|mimes:pdf|max:20480',
            'curriculum_text'   => 'nullable|string',

            // ================= SEAT DISTRIBUTION =================
            'seat_category'     => 'required|array|min:1',
            'seat_category.*'   => 'required|string|max:255',

            'seat_count'        => 'required|array|min:1',
            'seat_count.*'      => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'course_name.required' => 'Course name is required.',
            'course_name.min'      => 'Course name must be at least 3 characters.',

            'category_id.required' => 'Please select a category.',
            'category_id.exists'   => 'Selected category is invalid.',

            'description.required' => 'Course description is required.',
            'description.min'      => 'Description must be at least 10 characters.',

            'tuition_fees.required' => 'Tuition fee is required.',
            'tuition_fees.numeric'  => 'Tuition fee must be a number.',

            'admission_fees.required' => 'Admission fee is required.',

            'total_fees.required' => 'Total fee is required.',

            'min_percentage.numeric' => 'Minimum percentage must be a number between 0 and 100.',
            'min_percentage.max'     => 'Percentage cannot exceed 100.',

            'seat_category.required' => 'At least one seat category is required.',
            'seat_category.*.required' => 'Seat category name is required.',

            'seat_count.required' => 'Seat count is required.',
            'seat_count.*.required' => 'Seat count is required for each category.',
        ];
    }
}
