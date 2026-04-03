<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversityGalleryController extends Controller
{
    public function index()
    {
        $albums = Album::where('university_id', auth()->user()->university_id)->withCount('images')->get();
        return view('university.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('university.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:albums,name,NULL,id,university_id,' . auth()->user()->university_id,
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'caption.*' => 'nullable|string|max:255',
            'alt_text.*' => 'nullable|string|max:255',
        ]);
        $album = Album::create([
            'university_id' => auth()->user()->university_id,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 'Draft',
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('gallery', 'public');
                // Thumbnail logic can be added here
                Image::create([
                    'album_id' => $album->id,
                    'image_url' => $path,
                    'caption' => $request->caption[$idx] ?? null,
                    'alt_text' => $request->alt_text[$idx] ?? null,
                    'status' => 'Pending',
                ]);
            }
        }
        return redirect()->route('university.gallery.index')->with('success', 'Album and images uploaded!');
    }

    public function show(Album $album)
    {
        $images = $album->images;
        return view('university.gallery.show', compact('album', 'images'));
    }

    public function edit(Album $gallery)
    {
        // $gallery is the Album model due to resource route binding
        return view('university.gallery.edit', [
            'album' => $gallery,
        ]);
    }

    public function update(Request $request, Album $gallery)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:albums,name,' . $gallery->id . ',id,university_id,' . auth()->user()->university_id,
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
        $gallery->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'date' => $request->date,
        ]);
        return redirect()->route('university.gallery.index')->with('success', 'Album updated successfully!');
    }
}
