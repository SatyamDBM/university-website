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
            'course_name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'duration' => 'required|string',
            'course_type' => 'required|in:Full-time,Part-time,Online',
            'mode' => 'required|in:Offline,Hybrid,Online',
            'tuition_fees' => 'required|numeric|min:1',
            'hostel_fees' => 'nullable|numeric|min:1',
            'admission_fees' => 'required|numeric|min:1',
            'total_fees' => 'required|numeric|min:1',
            'min_qualification' => 'required|string|min:3|max:255',
            'min_percentage' => 'required|string|min:1|max:3',
            'required_exams' => 'nullable|string|min:3|max:255',
            'age_limit' => 'nullable|string|min:1|max:3',
            'curriculum_file' => 'nullable|file|mimes:pdf|max:20480',
            'curriculum_text' => 'nullable|string|min:3|max:65535',
            'seat_availability' => 'nullable|integer|min:1',
            'admission_status' => 'required|in:Open,Closed',
        ];
    }
}
