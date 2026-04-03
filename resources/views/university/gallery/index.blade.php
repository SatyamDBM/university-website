@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Campus Gallery</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all your campus albums</p>
        </div>
        <a href="{{ route('university.gallery.create') }}"
           class="inline-flex items-center gap-2 bg-[#6b4a36] hover:bg-[#5a3d2e] text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Create New Album
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr style="background-color: #6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Album</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Images</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($albums as $index => $album)
                    <tr class="hover:bg-gray-50 transition" id="row-{{ $album->id }}">
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-4 py-4 text-sm font-semibold text-gray-800">{{ $album->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $album->category }}</td>
                        <td class="px-4 py-4 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                @if($album->status === 'approved') bg-green-100 text-green-700
                                @elseif($album->status === 'pending') bg-amber-100 text-amber-700
                                @elseif($album->status === 'rejected') bg-red-100 text-red-600
                                @else bg-gray-100 text-gray-600 @endif">
                                {{ ucfirst($album->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm">{{ $album->images_count }}</td>
                        <td class="px-4 py-4 flex gap-2">
                            <a href="{{ route('university.gallery.show', $album) }}"
                               class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
                                View
                            </a>
                            <a href="{{ route('university.gallery.edit', $album) }}"
                               class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('university.gallery.destroy', $album) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-400 py-6">No albums found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
