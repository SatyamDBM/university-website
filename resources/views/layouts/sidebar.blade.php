<div
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 border-r
           transform transition-transform duration-300
           -translate-x-full md:translate-x-0"
    :class="{ 'translate-x-0': sidebarOpen }"
>
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b">
        <img src="{{ asset('storage/logo/logo.jpeg') }}"
             class="h-8 object-contain"
             alt="Logo">
    </div>

    <!-- Menu -->
    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}"
           class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            📊 Dashboard
        </a>

        <a href="#"
           class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            🎓 Courses
        </a>

        <a href="#"
           class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            👨‍🎓 Students
        </a>
    </nav>
</div>
