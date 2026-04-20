 @forelse($albums as $index => $album)
                    <tr class="hover:bg-gray-50 transition" id="row-{{ $album->id }}">

                        {{-- # --}}
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ $index + 1 }}
                        </td>

                        {{-- Album Name --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-semibold text-gray-800">{{ $album->name }}</div>
                            @if(!empty($album->description))
                                <div class="text-xs text-gray-400 mt-0.5">{{ Str::limit($album->description, 50) }}</div>
                            @endif
                        </td>

                        {{-- Category --}}
                        <td class="px-4 py-4 text-sm text-gray-600">
                            {{ $album->category ?? '—' }}
                        </td>

                        {{-- Images Count --}}
                        <td class="px-4 py-4">
                            <div class="inline-flex items-center gap-1 text-sm text-gray-700">
                                🖼️ <span class="font-medium">{{ $album->images_count ?? 0 }}</span>
                                <span class="text-gray-400 text-xs">images</span>
                            </div>
                        </td>

                        {{-- Approval Status --}}
                        <td class="px-4 py-4">
                            @php
                                $statusColor = match($album->status) {
                                    'approved' => 'bg-green-100 text-green-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    'rejected' => 'bg-red-100 text-red-600',
                                    default    => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                                {{ ucfirst($album->status) }}
                            </span>
                        </td>

                        {{-- Active Toggle --}}
                        <td class="px-4 py-4">
                            <button
                                onclick="toggleActive({{ $album->id }}, this)"
                                data-active="{{ $album->is_active ?? 1 }}"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none"
                                style="{{ ($album->is_active ?? 1) ? 'background-color:#6b4a36;' : 'background-color:#d1d5db;' }}"
                            >
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform
                                             {{ ($album->is_active ?? 1) ? 'translate-x-6' : 'translate-x-1' }}">
                                </span>
                            </button>
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('university.gallery.showById', $album->id) }}"
                                   class="text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition">
                                    View
                                </a>
                                <a href="{{ route('university.gallery.edit', $album) }}"
                                   class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                    Edit
                                </a>
                                <button onclick="deleteAlbum({{ $album->id }})"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center">
                            <div class="text-gray-400 text-sm">No albums found.</div>
                            <a href="{{ route('university.gallery.create') }}"
                               class="inline-flex items-center gap-1 mt-3 text-sm font-medium"
                               style="color:#6b4a36;">
                                + Create your first album
                            </a>
                        </td>
                    </tr>
                    @endforelse