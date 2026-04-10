<?php

namespace App\Http\Controllers;

use App\Models\UniversityFaq;
use Illuminate\Http\Request;

class UniversityFaqController extends Controller
{
    public function index()
    {
        $university_id = auth()->user()->university_id;
        $faqs = UniversityFaq::where('university_id', $university_id)->latest()->get();
        return view('university.faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $university_id = auth()->user()->university_id;
        $validated = $request->validate([
            'id' => 'nullable|exists:university_faqs,id',
            'question' => 'nullable|string',
            'answer' => 'nullable|string',
        ]);
        $faq = UniversityFaq::updateOrCreate(
            [
                'id' => $validated['id'] ?? null,
                'university_id' => $university_id
            ],
            [
                'question' => $validated['question'] ?? null,
                'answer' => $validated['answer'] ?? null,
            ]
        );
        return redirect()->route('university.faq.index')->with('success', 'FAQ saved successfully!');
    }

    public function edit($id)
    {
        $university_id = auth()->user()->university_id;
        $faq = UniversityFaq::where('university_id', $university_id)->findOrFail($id);
        return response()->json($faq);
    }

    public function destroy($id)
    {
        $university_id = auth()->user()->university_id;
        $faq = UniversityFaq::where('university_id', $university_id)->findOrFail($id);
        $faq->delete();
        return response()->json(['success' => true]);
    }
}
