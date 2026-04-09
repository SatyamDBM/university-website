@extends('layouts.app')
@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Recruiter</h1>
    <form method="POST" action="{{ route('recruiters.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4 bg-white p-6 rounded-xl border">
            <div>
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-input w-full" required value="{{ old('company_name') }}">
            </div>
            <div>
                <label>Industry Type</label>
                <input type="text" name="industry_type" class="form-input w-full" value="{{ old('industry_type') }}">
            </div>
            <div>
                <label>Logo</label>
                <input type="file" name="logo" class="form-input w-full" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Save Recruiter</button>
        </div>
    </form>
</div>
@endsection
