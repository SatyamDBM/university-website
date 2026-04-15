@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">University Overview</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your university profile and key information</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">

        {{-- ═══════════════════════════════
             LEFT: Preview (col-span-1)
        ═══════════════════════════════ --}}
        <div class="col-span-1 space-y-4">

            {{-- About Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🏫 About</h2>
                </div>
                <div class="p-5">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ optional($overview)->about ?? 'Not added yet.' }}
                    </p>
                </div>
            </div>

            {{-- Why Choose Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🌟 Why Choose</h2>
                </div>
                <div class="p-5">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {!! optional($overview)->why_choose ? nl2br(e($overview->why_choose)) : 'Not added yet.' !!}
                    </p>
                </div>
            </div>

            {{-- Accreditations --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🎓 Accreditations</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-wrap gap-2">
                        @forelse(optional($overview)->accreditations ?? [] as $badge)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                {{ $badge }}
                            </span>
                        @empty
                            <span class="text-sm text-gray-400">No accreditations added.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Brochure --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📄 Brochure</h2>
                </div>
                <div class="p-5">
                    @if(!empty($overview->brochure))
                        <a href="{{ asset('storage/' . $overview->brochure) }}" target="_blank"
                           class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
                           style="background-color:#6b4a36;">
                            📥 Download Brochure
                        </a>
                    @else
                        <span class="text-sm text-gray-400">No brochure uploaded.</span>
                    @endif
                </div>
            </div>

            {{-- Key Facts --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📊 Key Facts</h2>
                </div>
                <div class="p-5">
                    @php
                        $facts = [
                            ['label' => 'Established',      'value' => $overview->established_date ?? null, 'icon' => '📅'],
                            ['label' => 'Type',             'value' => $overview->university_type ?? null,   'icon' => '🏛️'],
                            ['label' => 'Location',         'value' => $overview->location ?? null,          'icon' => '📍'],
                            ['label' => 'Chancellor',       'value' => $overview->chancellor ?? null,        'icon' => '👤'],
                            ['label' => 'Campus Area',      'value' => $overview->campus_area ?? null,       'icon' => '🗺️'],
                            ['label' => 'Total Students',   'value' => $overview->total_students ?? null,    'icon' => '👨‍🎓'],
                            ['label' => 'Faculty',          'value' => $overview->faculty ?? null,           'icon' => '👩‍🏫'],
                            ['label' => 'Exams Accepted',   'value' => $overview->exams ?? null,             'icon' => '📝'],
                            ['label' => 'Application Fee',  'value' => $overview->application_fee ?? null,   'icon' => '💰'],
                            ['label' => 'NAAC Score',       'value' => $overview->naac_score ?? null,        'icon' => '⭐'],
                        ];
                    @endphp
                    <div class="space-y-2">
                        @foreach($facts as $fact)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <span class="text-xs text-gray-500 flex items-center gap-1.5">
                                {{ $fact['icon'] }} {{ $fact['label'] }}
                            </span>
                            <span class="text-xs font-semibold text-gray-800">
                                {{ $fact['value'] ?? '—' }}
                            </span>
                        </div>
                        @endforeach

                        {{-- Website --}}
                        <div class="flex items-center justify-between py-2">
                            <span class="text-xs text-gray-500 flex items-center gap-1.5">🌐 Website</span>
                            @if(optional($overview)->website)
                                <a href="{{ $overview->website }}" target="_blank"
                                   class="text-xs font-semibold text-blue-600 hover:underline">
                                    Visit →
                                </a>
                            @else
                                <span class="text-xs font-semibold text-gray-800">—</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ═══════════════════════════════
             RIGHT: Edit Form (col-span-2)
        ═══════════════════════════════ --}}
        <div class="col-span-2">

            <form action="{{ route('university.overview.store') }}" method="POST"
                  enctype="multipart/form-data" id="overviewForm">
                @csrf

                <div class="space-y-6">

                    {{-- About + Why Choose --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-5 py-3" style="background-color:#6b4a36;">
                            <h2 class="text-sm font-semibold text-white">📝 Description</h2>
                        </div>
                        <div class="p-5 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">
                                    About the University <span class="text-red-500">*</span>
                                </label>
                                <textarea name="about" rows="4"
                                          placeholder="Describe your university..."
                                          class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">{{ old('about', $overview->about ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Why Choose Us</label>
                                <textarea name="why_choose" rows="3"
                                          placeholder="Why should students choose your university..."
                                          class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">{{ old('why_choose', $overview->why_choose ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Key Facts --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-5 py-3" style="background-color:#6b4a36;">
                            <h2 class="text-sm font-semibold text-white">📊 Key Facts</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Established</label>
                                    <input type="text" name="established_date"
                                           value="{{ old('established_date', $overview->established_date ?? '') }}"
                                           placeholder="e.g. 1985"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">University Type</label>
                                    <input type="text" name="university_type"
                                           value="{{ old('university_type', $overview->university_type ?? '') }}"
                                           placeholder="e.g. Private, Deemed"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Location</label>
                                    <input type="text" name="location"
                                           value="{{ old('location', $overview->location ?? '') }}"
                                           placeholder="e.g. Mumbai, Maharashtra"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Chancellor</label>
                                    <input type="text" name="chancellor"
                                           value="{{ old('chancellor', $overview->chancellor ?? '') }}"
                                           placeholder="Chancellor name"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Campus Area</label>
                                    <input type="text" name="campus_area"
                                           value="{{ old('campus_area', $overview->campus_area ?? '') }}"
                                           placeholder="e.g. 50 Acres"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Total Students</label>
                                    <input type="number" name="total_students"
                                           value="{{ old('total_students', $overview->total_students ?? '') }}"
                                           placeholder="e.g. 15000"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Faculty</label>
                                    <input type="text" name="faculty"
                                           value="{{ old('faculty', $overview->faculty ?? '') }}"
                                           placeholder="e.g. 500+"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Exams Accepted</label>
                                    <input type="text" name="exams"
                                           value="{{ old('exams', $overview->exams ?? '') }}"
                                           placeholder="e.g. JEE, CAT, NEET"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Application Fee</label>
                                    <input type="text" name="application_fee"
                                           value="{{ old('application_fee', $overview->application_fee ?? '') }}"
                                           placeholder="e.g. ₹1000"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">NAAC Score</label>
                                    <input type="text" name="naac_score"
                                           value="{{ old('naac_score', $overview->naac_score ?? '') }}"
                                           placeholder="e.g. A++ (3.51)"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Website URL</label>
                                    <input type="url" name="website"
                                           value="{{ old('website', $overview->website ?? '') }}"
                                           placeholder="https://www.university.ac.in"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Accreditations --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-5 py-3" style="background-color:#6b4a36;">
                            <h2 class="text-sm font-semibold text-white">🎓 Accreditations</h2>
                        </div>
                        <div class="p-5">
                            <div id="accreditation-wrapper" class="space-y-2 mb-3">
                                @php
                                    $accreditations = old('accreditations', $overview->accreditations ?? []);
                                @endphp
                                @forelse($accreditations as $value)
                                <div class="flex gap-2 items-center">
                                    <input type="text" name="accreditations[]" value="{{ $value }}"
                                           placeholder="e.g. UGC Approved, NAAC A+"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                    <button type="button" onclick="removeField(this)"
                                            class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
                                </div>
                                @empty
                                <div class="flex gap-2 items-center">
                                    <input type="text" name="accreditations[]"
                                           placeholder="e.g. UGC Approved, NAAC A+"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                                    <button type="button" onclick="removeField(this)"
                                            class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
                                </div>
                                @endforelse
                            </div>
                            <button type="button" onclick="addField()"
                                    class="inline-flex items-center gap-2 text-sm font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                                + Add Accreditation
                            </button>
                        </div>
                    </div>

                    {{-- Brochure --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-5 py-3" style="background-color:#6b4a36;">
                            <h2 class="text-sm font-semibold text-white">📄 Brochure (PDF)</h2>
                        </div>
                        <div class="p-5">
                            @if(!empty($overview->brochure))
                            <div class="flex items-center gap-3 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <span class="text-2xl">📄</span>
                                <div>
                                    <div class="text-sm font-medium text-gray-700">Current Brochure</div>
                                    <a href="{{ asset('storage/' . $overview->brochure) }}" target="_blank"
                                       class="text-xs text-blue-600 hover:underline">View / Download</a>
                                </div>
                            </div>
                            @endif
                            <input type="file" name="brochure" accept="application/pdf"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            <p class="text-xs text-gray-400 mt-1">PDF only · Max 10MB
                                @if(!empty($overview->brochure))
                                · Leave empty to keep current
                                @endif
                            </p>
                            @error('brochure')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-between">
                        <p class="text-xs text-gray-400">All fields marked <span class="text-red-500">*</span> are required</p>
                        <button type="submit"
                                class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition"
                                style="background-color:#6b4a36;">
                            💾 Save Overview
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<script>
function addField() {
    const wrapper = document.getElementById('accreditation-wrapper');
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-center';
    div.innerHTML = `
        <input type="text" name="accreditations[]"
               placeholder="e.g. UGC Approved, NAAC A+"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition">
        <button type="button" onclick="removeField(this)"
                class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
    `;
    wrapper.appendChild(div);
}

function removeField(button) {
    button.parentElement.remove();
}
</script>

@endsection