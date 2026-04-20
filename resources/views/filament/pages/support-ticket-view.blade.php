<x-filament-panels::page>
    <div class="space-y-6">
        <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full px-3 py-1 text-xs font-medium
                            {{ $this->ticket->priority === 'high' ? 'bg-red-50 text-red-700' : '' }}
                            {{ $this->ticket->priority === 'medium' ? 'bg-yellow-50 text-yellow-700' : '' }}
                            {{ $this->ticket->priority === 'low' ? 'bg-green-50 text-green-700' : '' }}">
                            {{ ucfirst($this->ticket->priority) }} Priority
                        </span>

                        <span class="rounded-full px-3 py-1 text-xs font-medium
                            {{ $this->ticket->status === 'open' ? 'bg-yellow-50 text-yellow-700' : '' }}
                            {{ $this->ticket->status === 'replied' ? 'bg-blue-50 text-blue-700' : '' }}
                            {{ $this->ticket->status === 'closed' ? 'bg-green-50 text-green-700' : '' }}">
                            {{ ucfirst($this->ticket->status) }}
                        </span>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $this->ticket->subject }}
                        </h1>

                        <p class="mt-2 text-sm text-gray-500">
                            Ticket ID: #{{ $this->ticket->id }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium text-gray-700">University ID:</span>
                            {{ $this->ticket->university_id }}
                        </div>

                        <div>
                            <span class="font-medium text-gray-700">Created At:</span>
                            {{ $this->ticket->created_at?->format('d M Y h:i A') }}
                        </div>

                        @if($this->ticket->replied_at)
                            <div>
                                <span class="font-medium text-gray-700">Replied At:</span>
                                {{ $this->ticket->replied_at?->format('d M Y h:i A') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a
                        href="{{ route('filament.admin.pages.support-tickets') }}"
                        class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 hover:bg-gray-200 transition"
                    >
                        ⬅ Back to Tickets
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">
            <div class="xl:col-span-8 space-y-6">
                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-semibold text-gray-900">
                        University Message
                    </h2>

                    <div class="rounded bg-gray-50 p-4 text-sm leading-7 text-gray-700 border border-gray-100">
                        {{ $this->ticket->message ?: 'No message available.' }}
                    </div>
                </div>

                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Admin Reply
                        </h2>

                        @if($this->ticket->admin_reply)
                            <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-700">
                                Replied
                            </span>
                        @endif
                    </div>

                    <div class="rounded border border-blue-100 bg-blue-50 p-4 text-sm leading-7 text-gray-700 min-h-[100px]">
                        {{ $this->ticket->admin_reply ?: 'No reply available yet.' }}
                    </div>

                    <form wire:submit="submitReply" class="mt-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                Add / Update Reply
                            </label>

                            <textarea
                                wire:model.defer="admin_reply"
                                rows="6"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 shadow-sm focus:border-[#775042] focus:outline-none focus:ring-2 focus:ring-[#775042]/20"
                                placeholder="Write your reply here..."
                            ></textarea>

                            @error('admin_reply')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-[5px] bg-[#775042] px-5 py-2.5 text-sm font-medium text-white transition hover:opacity-90"
                            >
                                Submit Reply
                            </button>
                        </div>
                    </form>
                </div>

                @if($this->ticket->attachment)
                    <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                        <h2 class="mb-4 text-lg font-semibold text-gray-900">
                            Attachment
                        </h2>

                        <a
                            href="{{ asset('storage/' . $this->ticket->attachment) }}"
                            target="_blank"
                            class="inline-flex items-center rounded-[5px] bg-[#775042] px-4 py-2 text-sm font-medium text-white transition hover:opacity-90"
                        >
                            View Attachment
                        </a>
                    </div>
                @endif
            </div>

            <div class="xl:col-span-4">
                <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-5 text-lg font-semibold text-gray-900">
                        Ticket Details
                    </h2>

                    <div class="space-y-5">
                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Ticket ID
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                #{{ $this->ticket->id }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                University ID
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->ticket->university_id }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Priority
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ ucfirst($this->ticket->priority) }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Status
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ ucfirst($this->ticket->status) }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Replied By
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->ticket->replied_by ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Last Updated
                            </p>

                            <p class="mt-2 text-sm text-gray-700">
                                {{ $this->ticket->updated_at?->format('d M Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>