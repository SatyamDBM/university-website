@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Recruiters</h1>
        <a href="{{ route('recruiters.create') }}" class="btn btn-primary">+ Add Recruiter</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Company Name</th>
                <th>Industry</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recruiters as $recruiter)
            <tr>
                <td>
                    @if($recruiter->logo)
                        <img src="{{ asset('storage/' . $recruiter->logo) }}" alt="Logo" class="w-16 h-16 object-contain">
                    @else
                        <span class="text-gray-400">No Logo</span>
                    @endif
                </td>
                <td>{{ $recruiter->company_name }}</td>
                <td>{{ $recruiter->industry_type ?? '-' }}</td>
                <td>
                    <a href="{{ route('recruiters.edit', $recruiter) }}">Edit</a>
                    <form action="{{ route('recruiters.destroy', $recruiter) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this recruiter?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
