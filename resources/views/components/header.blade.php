<header class="sticky top-0 z-50 bg-gradient-to-r from-[#0b1c2d] to-[#0e2a47] text-white">

    {{-- TOP BAR --}}
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-4">

        {{-- LOGO --}}
        <div class="flex items-center gap-2 shrink-0">
            <img src="{{ asset('storage/logo/logo.jpeg') }}"
                 class="h-9 object-contain"
                 alt="Logo">
        </div>

        {{-- GOAL / CITY --}}
        <div class="hidden md:flex items-center gap-1 text-sm text-orange-400 cursor-pointer">
            <span>Select Goal</span>
            <span>&</span>
            <span>City</span>
        </div>

        {{-- SEARCH --}}
        <div class="flex-1">
            <input
                type="text"
                placeholder="Search for Colleges, Exams, Courses and More..."
                class="w-full px-4 py-2 rounded text-gray-800 text-sm focus:outline-none"
            >
        </div>

        {{-- RIGHT ACTIONS --}}
        <div class="hidden md:flex items-center gap-5 text-sm">

            <a href="#" class="hover:text-orange-400">Write a Review</a>

            <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-xs font-semibold">
                Get Upto ₹300*
            </a>

            <a href="#" class="hover:text-orange-400">Explore</a>

        </div>
    </div>

    {{-- NAV BAR --}}
    <div class="bg-[#0b1c2d] border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 py-2 flex gap-6 text-sm overflow-x-auto">

            <a href="#" class="hover:text-orange-400 whitespace-nowrap">All Courses</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">B.Tech</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">MBA</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">M.Tech</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">MBBS</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">B.Com</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">B.Sc</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">BA</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">BBA</a>
            <a href="#" class="hover:text-orange-400 whitespace-nowrap">BCA</a>

            <div class="ml-auto flex gap-6">
                <a href="#" class="hover:text-orange-400">Study Abroad</a>
                <a href="#" class="hover:text-orange-400">Course Finder</a>
            </div>
        </div>
    </div>

</header>
