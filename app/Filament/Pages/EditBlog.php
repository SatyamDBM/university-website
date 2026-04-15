<?php

namespace App\Filament\Pages;

use App\Models\Blog;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditBlog extends Page
{
    use WithFileUploads;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.edit-blog';

    public ?Blog $blog = null;

    public $category_name = '';
    public $blog_title = '';
    public $blog_slug = '';
    public $short_description = '';
    public $featured_image = null;
    public $old_featured_image = '';
    public $status = 'draft';
    public $publish_type = 'instant';
    public $publish_date = '';
    public $content = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $tags = '';
    public $canonical_url = '';

    public function mount(): void
    {
        $this->blog = Blog::with('detail')->findOrFail(request()->id);

        $this->category_name = $this->blog->category_name ?? '';
        $this->blog_title = $this->blog->title ?? '';
        $this->blog_slug = $this->blog->slug ?? '';
        $this->short_description = $this->blog->short_description ?? '';
        $this->old_featured_image = $this->blog->featured_image ?? '';
        $this->status = $this->blog->status ?? 'draft';
        $this->publish_type = $this->blog->publish_type ?? 'instant';
        $this->publish_date = $this->blog->publish_date
            ? date('Y-m-d\TH:i', strtotime($this->blog->publish_date))
            : '';

        $this->content = $this->blog->detail?->content ?? '';
        $this->meta_title = $this->blog->detail?->meta_title ?? '';
        $this->meta_description = $this->blog->detail?->meta_description ?? '';
        $this->meta_keywords = $this->blog->detail?->meta_keywords ?? '';
        $this->tags = $this->blog->detail?->tags ?? '';
        $this->canonical_url = $this->blog->detail?->canonical_url ?? '';
    }

    public function updatedBlogTitle(): void
    {
        $this->blog_slug = Str::slug($this->blog_title);
    }

    public function updateBlog(): void
    {
        $this->validate([
            'category_name' => ['nullable', 'string', 'max:255'],
            'blog_title' => ['required', 'string', 'max:255'],
            'blog_slug' => ['required', 'string', 'max:255', 'unique:blogs,slug,' . $this->blog->id],
            'short_description' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
            'publish_type' => ['required', 'in:instant,scheduled'],
            'publish_date' => ['nullable'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'tags' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $this->old_featured_image;

        if ($this->featured_image) {
            if ($this->old_featured_image && Storage::disk('public')->exists($this->old_featured_image)) {
                Storage::disk('public')->delete($this->old_featured_image);
            }

            $imagePath = $this->featured_image->store('blogs', 'public');
        }

        $this->blog->update([
            'category_name' => $this->category_name,
            'title' => $this->blog_title,
            'slug' => $this->blog_slug,
            'short_description' => $this->short_description,
            'featured_image' => $imagePath,
            'status' => $this->status,
            'publish_type' => $this->publish_type,
            'publish_date' => $this->publish_date ?: null,
        ]);

        $this->blog->detail()->updateOrCreate(
            ['blog_id' => $this->blog->id],
            [
                'content' => $this->content,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords,
                'tags' => $this->tags,
                'canonical_url' => $this->canonical_url,
            ]
        );

        Notification::make()
            ->title('Blog updated successfully')
            ->success()
            ->send();

        $this->redirect('/admin/blog');
    }
}