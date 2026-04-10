@extends('layouts.app')

@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Finance & Admission Details</h1>
            <p class="text-sm text-gray-500">Complete university configuration view</p>
        </div>

        <a href="{{ route('university.finance.index') }}"
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">
            ← Back
        </a>
    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ================= ADMISSION PROCESS ================= --}}
        <div class="bg-white rounded-xl shadow border overflow-hidden">

            <div class="p-4 font-bold text-white" style="background:#6b4a36;">
                📋 Admission Process
            </div>

            <div class="p-4 space-y-4">

                {{-- STEPS --}}
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Steps</h3>

                    @forelse($process->steps ?? [] as $step)
                        <div class="border-b py-2">
                            <div class="font-medium">{{ $step->title }}</div>
                            <div class="text-xs text-gray-500">{{ $step->description }}</div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">No steps found</p>
                    @endforelse
                </div>

                {{-- DATES --}}
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Important Dates</h3>

                    @forelse($process->dates ?? [] as $date)
                        <div class="flex justify-between text-sm border-b py-1">
                            <span>{{ $date->label }}</span>
                            <span class="text-gray-500">{{ $date->value }}</span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">No dates found</p>
                    @endforelse
                </div>

                {{-- CUTOFFS --}}
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Cutoffs</h3>

                    @forelse($process->cutoffs ?? [] as $cutoff)
                        <div class="text-sm border-b py-1">
                            {{ $cutoff->course }} -
                            {{ $cutoff->exam }} -
                            <b>{{ $cutoff->cutoff }}</b>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">No cutoffs found</p>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- ================= SCHOLARSHIPS ================= --}}
        <div class="bg-white rounded-xl shadow border overflow-hidden">

            <div class="p-4 font-bold text-white" style="background:#6b4a36;">
                🎓 Scholarships
            </div>

            <div class="p-4 space-y-3">

                @forelse($scholarships as $sch)
                    <div class="border-b pb-2">
                        <div class="font-semibold text-gray-800">
                            {{ $sch->title }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $sch->description }}
                        </div>

                        @if($sch->badge)
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded mt-1 inline-block">
                                {{ $sch->badge }}
                            </span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No scholarships found</p>
                @endforelse

            </div>
        </div>

        {{-- ================= LOAN PARTNERS ================= --}}
        <div class="bg-white rounded-xl shadow border overflow-hidden md:col-span-2">

            <div class="p-4 font-bold text-white" style="background:#6b4a36;">
                🏦 Loan Partners
            </div>

            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">

                @forelse($loanPartners as $lp)
                    <div class="border rounded-lg p-3 flex items-center gap-3">

                        @if($lp->logo)
                            <img src="{{ asset('storage/'.$lp->logo) }}"
                                 class="h-10 w-10 rounded object-contain border">
                        @endif

                        <div>
                            <div class="font-semibold text-gray-800">
                                {{ $lp->bank_name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $lp->interest_rate }} • {{ $lp->amount }}
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="text-gray-400 text-sm col-span-3">
                        No loan partners found
                    </p>
                @endforelse

            </div>
        </div>

    </div>

</div>
@endsection