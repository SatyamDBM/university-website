<x-filament-panels::page>
    <div class="space-y-6">
        <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                            {{ ucfirst($this->blog->category_name ?? 'No Category') }}
                        </span>

                        <span class="rounded-full px-3 py-1 text-xs font-medium {{ $this->blog->status === 'published' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                            {{ ucfirst($this->blog->status) }}
                        </span>

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            {{ ucfirst($this->blog->publish_type) }}
                        </span>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $this->blog->title }}
                        </h1>

                        <p class="mt-2 text-sm text-gray-500">
                            Slug: {{ $this->blog->slug }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium text-gray-700">Created At:</span>
                            {{ $this->blog->created_at?->format('d M Y h:i A') }}
                        </div>

                        @if($this->blog->publish_date)
                            <div>
                                <span class="font-medium text-gray-700">Publish Date:</span>
                                {{ \Carbon\Carbon::parse($this->blog->publish_date)->format('d M Y h:i A') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a
                        href="{{ url('/admin/blog') }}"
                        class="rounded-[5px] border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Back
                    </a>

                    <a
                        href="{{ route('filament.admin.pages.edit-blog', ['id' => $this->blog->id]) }}"
                        class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                    >
                        Edit Blog
                    </a>
                </div>
            </div>
        </div>

        @if($this->blog->featured_image)
            <div class="rounded border border-gray-200 bg-white p-5 shadow-sm">
                <div class="overflow-hidden rounded border border-gray-100">
                    <img
                        src="{{ asset('storage/' . $this->blog->featured_image) }}"
                        alt="{{ $this->blog->title }}"
                        class="h-[420px] w-full object-cover"
                    >
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">
            <div class="xl:col-span-8 space-y-6">
                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-semibold text-gray-900">
                        Short Description
                    </h2>

                    <div class="rounded bg-gray-50 p-4 text-sm leading-7 text-gray-700">
                        {{ $this->blog->short_description ?: 'No short description available.' }}
                    </div>
                </div>

                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-lg font-semibold text-gray-900">
                        Blog Content
                    </h2>

                    <div class="prose prose-sm max-w-none text-gray-700">
                        {!! $this->blog->detail?->content ?: '<p>No content available.</p>' !!}
                    </div>
                </div>
            </div>

            <div class="xl:col-span-4">
                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-lg font-semibold text-gray-900">
                        SEO Details
                    </h2>

                    <div class="space-y-5">
                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Meta Title
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->blog->detail?->meta_title ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Meta Description
                            </p>

                            <p class="mt-2 text-sm leading-6 text-gray-700">
                                {{ $this->blog->detail?->meta_description ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Meta Keywords
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->blog->detail?->meta_keywords ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Tags
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->blog->detail?->tags ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Canonical URL
                            </p>

                            <p class="mt-2 break-all text-sm text-blue-600">
                                {{ $this->blog->detail?->canonical_url ?: '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>