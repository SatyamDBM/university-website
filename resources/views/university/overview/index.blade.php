@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-8 space-y-10">

    {{-- ===================== --}}
    {{-- 🔹 OVERVIEW PREVIEW --}}
    {{-- ===================== --}}
    <div>

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            University Overview
        </h1>

        {{-- About --}}
        <div class="bg-white border rounded-xl p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">🏫 About the University</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ optional($overview)->about ?? '-' }}
            </p>
        </div>

        {{-- Why Choose --}}
        <div class="bg-white border rounded-xl p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                🌟 Why Choose {{ $university->name ?? 'the University' }}?
            </h2>
            <div class="text-gray-600 leading-relaxed space-y-2">
                {!! optional($overview)->why_choose ? nl2br(e($overview->why_choose)) : '-' !!}
            </div>
        </div>

        {{-- Key Facts --}}
        <div class="bg-white border rounded-xl p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">📊 Key Facts</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @php
                    $facts = [
                        'Established' => $overview->established_date ?? '-',
                        'Type' => $overview->university_type ?? '-',
                        'Location' => $overview->location ?? '-',
                        'Chancellor' => $overview->chancellor ?? '-',
                        'Campus Area' => $overview->campus_area ?? '-',
                        'Students' => $overview->total_students ?? '-',
                        'Faculty' => $overview->faculty ?? '-',
                        'Exams' => $overview->exams ?? '-',
                        'Application Fee' => $overview->application_fee ?? '-',
                        'NAAC Score' => $overview->naac_score ?? '-',
                    ];
                @endphp

                @foreach($facts as $label => $value)
                    <div class="border rounded-lg p-3 bg-gray-50">
                        <div class="text-xs text-gray-500">{{ $label }}</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ $value }}</div>
                    </div>
                @endforeach

                {{-- Website --}}
                <div class="border rounded-lg p-3 bg-gray-50 col-span-2 md:col-span-2">
                    <div class="text-xs text-gray-500">Website</div>
                    @if(optional($overview)->website)
                        <a href="{{ $overview->website }}" target="_blank"
                           class="text-blue-600 font-semibold hover:underline mt-1 inline-block">
                            Visit Website
                        </a>
                    @else
                        <div class="font-semibold text-gray-800 mt-1">-</div>
                    @endif
                </div>

            </div>
        </div>

        {{-- Accreditations --}}
        <div class="bg-white border rounded-xl p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">🎓 Accreditations</h2>

            <div class="flex flex-wrap gap-2">
                @forelse((optional($overview)->accreditations ?? []) as $badge)
                    <span class="px-3 py-1 border rounded-full text-sm bg-gray-50 text-gray-700">
                        {{ $badge }}
                    </span>
                @empty
                    <span class="text-gray-400">-</span>
                @endforelse
            </div>
        </div>

    </div>


    {{-- ===================== --}}
    {{-- 🔹 EDIT FORM --}}
    {{-- ===================== --}}
    <div class="bg-white border rounded-xl p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Edit Overview
        </h2>

      <form action="{{ route('universities.overview.store') }}" method="POST" class="space-y-6">
    @csrf

            {{-- About --}}
            <div>
                <label class="block text-sm font-semibold mb-1">About the University</label>
                <textarea name="about" rows="4"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-[#6b4a36]">
                    {{ old('about', $overview->about ?? '') }}
                </textarea>
            </div>

            {{-- Why Choose --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Why Choose</label>
                <textarea name="why_choose" rows="3"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-[#6b4a36]">
                    {{ old('why_choose', $overview->why_choose ?? '') }}
                </textarea>
            </div>

            {{-- Grid Fields --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                <input type="text" name="established_date" placeholder="Established"
                       value="{{ old('established_date', $overview->established_date ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="university_type" placeholder="Type"
                       value="{{ old('university_type', $overview->university_type ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="location" placeholder="Location"
                       value="{{ old('location', $overview->location ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="chancellor" placeholder="Chancellor"
                       value="{{ old('chancellor', $overview->chancellor ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="campus_area" placeholder="Campus Area"
                       value="{{ old('campus_area', $overview->campus_area ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="total_students" placeholder="Students"
                       value="{{ old('total_students', $overview->total_students ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="faculty" placeholder="Faculty"
                       value="{{ old('faculty', $overview->faculty ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="exams" placeholder="Exams"
                       value="{{ old('exams', $overview->exams ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="application_fee" placeholder="Application Fee"
                       value="{{ old('application_fee', $overview->application_fee ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="naac_score" placeholder="NAAC Score"
                       value="{{ old('naac_score', $overview->naac_score ?? '') }}"
                       class="border rounded-lg px-3 py-2">

                <input type="text" name="website" placeholder="Website"
                       value="{{ old('website', $overview->website ?? '') }}"
                       class="border rounded-lg px-3 py-2 col-span-2 md:col-span-3">

            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button class="bg-[#6b4a36] text-white px-6 py-2 rounded-lg hover:opacity-90">
                    Save Overview
                </button>
            </div>

        </form>

    </div>

</div>

@endsection