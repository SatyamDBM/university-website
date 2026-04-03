<x-app-layout>

<div class="container max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add New Course</h1>

    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form id="courseForm" method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf
        @include('university.courses.partials.form')
        <div class="flex gap-3 mt-6">
            <button type="submit" name="save_as_draft" value="1" class="btn btn-secondary">Save as Draft</button>
            <button type="submit" class="btn btn-primary">Submit for Approval</button>
        </div>
    </form>
</div>

</x-app-layout>
