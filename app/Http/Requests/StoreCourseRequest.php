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
            'course_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'duration' => 'required|string',
            'course_type' => 'required|in:Full-time,Part-time,Online',
            'mode' => 'required|in:Offline,Hybrid,Online',
            'tuition_fees' => 'required|numeric|min:0',
            'hostel_fees' => 'nullable|numeric|min:0',
            'admission_fees' => 'required|numeric|min:0',
            'total_fees' => 'required|numeric|min:0',
            'min_qualification' => 'required|string',
            'min_percentage' => 'required|string',
            'required_exams' => 'nullable|string',
            'age_limit' => 'nullable|string',
            'curriculum_file' => 'nullable|file|mimes:pdf|max:20480',
            'curriculum_text' => 'nullable|string',
            'seat_availability' => 'nullable|integer|min:0',
            'admission_status' => 'required|in:Open,Closed',
        ];
    }
}
