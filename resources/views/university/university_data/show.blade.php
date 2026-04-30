@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Finance & Admission Details</h1>
            <p class="text-sm text-gray-500 mt-1">Complete university configuration view</p>
        </div>
        <a href="{{ route('university.finance.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back
        </a>
    </div>

    <div class="space-y-6">

        {{-- ═══════════════════════════════════════
             SECTION 1: ADMISSION STEPS
        ════════════════════════════════════════ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                <h2 class="text-sm font-semibold text-white">📋 Admission Steps</h2>
                <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full">
                    {{ count($process->steps ?? []) }} Steps
                </span>
            </div>
            <div class="p-5">
                @forelse($process->steps ?? [] as $step)
                    <div class="flex gap-4">
                        {{-- Left: timeline --}}
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                                 style="background-color:#6b4a36;">
                                {{ $loop->iteration }}
                            </div>
                            @if(!$loop->last)
                                <div class="w-px flex-1 my-1" style="background-color:#e5d5cc; min-height:24px;"></div>
                            @endif
                        </div>
                        {{-- Right: content --}}
                        <div class="flex-1 pb-5">
                            <p class="text-sm font-semibold text-gray-800 mt-1">{{ $step->title }}</p>
                            @if($step->description)
                                <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $step->description }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-10 text-gray-300">
                        <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm">No admission steps added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ═══════════════════════════════════════
             SECTION 2: IMPORTANT DATES + CUTOFFS (side by side)
        ════════════════════════════════════════ --}}
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 24px;">

            {{-- IMPORTANT DATES --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📅 Important Dates</h2>
                    <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full">
                        {{ count($process->dates ?? []) }} Dates
                    </span>
                </div>
                <div class="p-5">
                    @forelse($process->dates ?? [] as $date)
                        <div class="flex items-center justify-between py-2.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="flex items-center gap-2.5">
                                <div class="w-2 h-2 rounded-full flex-shrink-0" style="background-color:#6b4a36;"></div>
                                <span class="text-sm text-gray-700">{{ $date->label }}</span>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                  style="background-color:#f5ede9; color:#6b4a36;">
                                {{ $date->value }}
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-10 text-gray-300">
                            <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                            </svg>
                            <p class="text-sm">No dates added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- CUTOFFS --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📊 Cutoffs</h2>
                    <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full">
                        {{ count($process->cutoffs ?? []) }} Entries
                    </span>
                </div>
                <div class="p-5">
                    @forelse($process->cutoffs ?? [] as $cutoff)
                        <div class="py-2.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ $cutoff->course->course_name ?? '—' }}
                                </span>
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-green-50 text-green-700 border border-green-100">
                                    {{ $cutoff->cutoff }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-400">
                                    Exam: <span class="text-gray-600 font-medium">{{ $cutoff->exam ?? '—' }}</span>
                                </span>
                                <span class="text-gray-200 text-xs">|</span>
                                <span class="text-xs text-gray-400">
                                    Year: <span class="text-gray-600 font-medium">{{ $cutoff->year ?? '—' }}</span>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-10 text-gray-300">
                            <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                            </svg>
                            <p class="text-sm">No cutoffs added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- ═══════════════════════════════════════
             SECTION 3: SCHOLARSHIPS
        ════════════════════════════════════════ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                <h2 class="text-sm font-semibold text-white">🎓 Scholarships</h2>
                <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full">
                    {{ $scholarships->count() }} {{ Str::plural('Scholarship', $scholarships->count()) }}
                </span>
            </div>
            <div class="p-5">
                @forelse($scholarships as $sch)
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;"
                         class="py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">

                        {{-- Left --}}
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="w-2 h-2 rounded-full flex-shrink-0" style="background-color:#6b4a36;"></div>
                                <p class="text-sm font-semibold text-gray-800">{{ $sch->title }}</p>
                            </div>
                            @if($sch->description)
                                <p class="text-xs text-gray-500 leading-relaxed pl-4">{{ $sch->description }}</p>
                            @endif
                        </div>

                        {{-- Right --}}
                        <div class="flex items-center justify-between">
                            @if($sch->badge)
                                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-50 text-green-700 border border-green-100">
                                    {{ $sch->badge }}
                                </span>
                            @else
                                <span></span>
                            @endif

                            @if($sch->priority)
                                <div class="flex flex-col items-center">
                                    <span class="text-xs text-gray-400 mb-0.5">Priority</span>
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white"
                                          style="background-color:#6b4a36;">
                                        {{ $sch->priority }}
                                    </span>
                                </div>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-10 text-gray-300">
                        <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                        <p class="text-sm">No scholarships added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ═══════════════════════════════════════
             SECTION 4: LOAN PARTNERS
        ════════════════════════════════════════ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                <h2 class="text-sm font-semibold text-white">🏦 Loan Partners</h2>
                <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full">
                    {{ $loanPartners->count() }} {{ Str::plural('Partner', $loanPartners->count()) }}
                </span>
            </div>
            <div class="p-5">
                @forelse($loanPartners as $lp)
                    <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">

                        {{-- Logo --}}
                        <div class="w-12 h-12 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($lp->logo)
                                <img src="{{ asset('storage/'.$lp->logo) }}"
                                     class="w-full h-full object-contain p-1.5"
                                     alt="{{ $lp->bank_name }}">
                            @else
                                <span class="text-base font-bold" style="color:#6b4a36;">
                                    {{ strtoupper(substr($lp->bank_name, 0, 2)) }}
                                </span>
                            @endif
                        </div>

                        {{-- Name --}}
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">{{ $lp->bank_name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">Education Loan Partner</p>
                        </div>

                        {{-- Interest Rate --}}
                        @if($lp->interest_rate)
                            <div class="text-center px-4 py-2 rounded-lg bg-blue-50 border border-blue-100">
                                <p class="text-xs text-blue-400 mb-0.5">Interest Rate</p>
                                <p class="text-sm font-bold text-blue-700">{{ $lp->interest_rate }}</p>
                            </div>
                        @endif

                        {{-- Loan Amount --}}
                        @if($lp->amount)
                            <div class="text-center px-4 py-2 rounded-lg border border-gray-100" style="background-color:#f5ede9;">
                                <p class="text-xs mb-0.5" style="color:#a07060;">Loan Amount</p>
                                <p class="text-sm font-bold" style="color:#6b4a36;">{{ $lp->amount }}</p>
                            </div>
                        @endif

                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-10 text-gray-300">
                        <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                        </svg>
                        <p class="text-sm">No loan partners added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection