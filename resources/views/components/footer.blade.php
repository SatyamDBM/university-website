<footer class="bg-white border-t">
    {{-- Newsletter --}}
    <div class="max-w-7xl mx-auto px-4 py-12 text-center">
        <h2 class="text-2xl font-semibold">Subscribe To Our News Letter</h2>
        <p class="text-sm text-gray-500 mt-1">
            Get College Notifications, Exam Notifications and News Updates
        </p>

        <form class="mt-6 flex flex-col md:flex-row gap-4 justify-center">
            <input
                type="email"
                placeholder="Enter your email id"
                class="border rounded px-4 py-2 w-full md:w-64"
            >
            <input
                type="text"
                placeholder="Enter your mobile no"
                class="border rounded px-4 py-2 w-full md:w-56"
            >
            <select class="border rounded px-4 py-2 w-full md:w-56">
                <option>Choose your course</option>
            </select>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded">
                Submit
            </button>
        </form>
    </div>

    {{-- Links --}}
    <div class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-2 md:grid-cols-6 gap-8 text-sm">
            
            <div>
                <h3 class="font-semibold mb-3">Top Colleges</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>MBA</li><li>B.Tech / BE</li><li>MCA</li><li>BCA</li>
                    <li>M.Tech</li><li>MA</li><li>BA</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Top Universities</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>Engineering</li><li>Management</li><li>Medical</li>
                    <li>Law</li><li>Commerce</li><li>Science</li><li>Arts</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Top Exam</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>CAT</li><li>GATE</li><li>JEE Main</li>
                    <li>NEET</li><li>XAT</li><li>CLAT</li><li>MAT</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Study Abroad</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>Canada</li><li>USA</li><li>UK</li><li>UAE</li>
                    <li>Australia</li><li>Germany</li><li>Sweden</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Countries</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>Ireland</li><li>New Zealand</li><li>Hong Kong</li>
                    <li>Singapore</li><li>Malaysia</li><li>Netherlands</li><li>Italy</li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Board Exams</h3>
                <ul class="space-y-2 text-gray-600">
                    <li>CBSE Class 12</li><li>CBSE 12th Results</li>
                    <li>CBSE 12th Syllabus</li><li>CBSE 12th Exam Dates</li>
                    <li>CBSE Class 10</li><li>CBSE 10th Result</li>
                    <li>CBSE 10th Syllabus</li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Bottom --}}
    <div class="bg-gray-100 border-t">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600 gap-4">
            <div>
                © {{ date('Y') }} Top Universities In India. All Rights Reserved
            </div>

            <div class="flex flex-wrap gap-4">
                @php
                    $cmsPages = \App\Models\CmsPage::where('is_active', 1)->get();
                @endphp

                @foreach ($cmsPages as $page)
                    <a
                        href="{{ url($page->slug) }}"
                        class="text-gray-600 hover:text-black transition"
                    >
                        {{ $page->title }}
                    </a>
                @endforeach
            </div>


        </div>
    </div>
</footer>
