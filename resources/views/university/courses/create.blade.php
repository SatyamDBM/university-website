<x-app-layout>
    <div class="mx-auto w-full">
        <div class="rounded-[10px] border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">
                    Add New Course
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Fill in the details below to create a new course.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-[6px] border border-red-200 bg-red-50 px-4 py-3">
                    <div class="mb-2 text-sm font-semibold text-red-700">
                        Please fix the following errors:
                    </div>

                    <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                id="courseForm"
                method="POST"
                action="{{ route('courses.store') }}"
                enctype="multipart/form-data"
                    class="border border-gray-200 rounded-xl p-6 bg-white space-y-6"
            >
                @csrf

                @include('university.courses.partials.form')

                <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
                                ← Back
                            </a>
                    <button
                        type="submit"
                        name="save_as_draft"
                        value="1"
                        class="rounded-[5px] border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Save as Draft
                    </button>

                    <button
                        type="submit"
                        class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white transition hover:bg-[#5e3d31]"
                    >
                        Submit for Approval
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>