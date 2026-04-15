<?php

namespace App\Filament\Pages;

use App\Models\Blog;
use App\Models\BlogDetail;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use UnitEnum;
use BackedEnum;

class CreateBlog extends Page
{
    use WithFileUploads;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Blogs';

    protected static ?string $navigationLabel = 'Create Blog';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Create Blog';

    protected string $view = 'filament.pages.create-blog';

    public $category_name = '';
    public $blog_title = '';
    public $blog_slug = '';         // ← slug → blog_slug (Filament conflict fix)
    public $short_description = '';
    public $featured_image = null;
    public $status = 'draft';
    public $publish_type = 'instant';
    public $publish_date = '';
    public $content = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $tags = '';
    public $canonical_url = '';

    public function updatedBlogTitle(): void
    {
        $this->blog_slug = Str::slug($this->blog_title);
    }

    public function createBlog(): void
    {
        $this->validate([
            'category_name'     => ['nullable', 'string', 'max:255'],
            'blog_title'        => ['required', 'string', 'max:255'],
            'blog_slug'         => ['required', 'string', 'max:255', 'unique:blogs,slug'],
            'short_description' => ['nullable', 'string'],
            'featured_image'    => ['nullable', 'image', 'max:2048'],
            'status'            => ['required', 'in:draft,published'],
            'publish_type'      => ['required', 'in:instant,scheduled'],
            'publish_date'      => ['nullable'],
            'content'           => ['nullable', 'string'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string'],
            'meta_keywords'     => ['nullable', 'string'],
            'tags'              => ['nullable', 'string'],
            'canonical_url'     => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = null;

        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('blogs', 'public');
        }

        $blog = Blog::create([
            'category_name'     => $this->category_name,
            'title'             => $this->blog_title,
            'slug'              => $this->blog_slug,
            'short_description' => $this->short_description,
            'featured_image'    => $imagePath,
            'status'            => $this->status,
            'publish_type'      => $this->publish_type,
            'publish_date'      => $this->publish_date ?: null,
            'created_by'        => Auth::id(),
        ]);

        BlogDetail::create([
            'blog_id'          => $blog->id,
            'content'          => $this->content,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords'    => $this->meta_keywords,
            'tags'             => $this->tags,
            'canonical_url'    => $this->canonical_url,
        ]);

        Notification::make()
            ->title('Blog created successfully')
            ->success()
            ->send();

        $this->reset([
            'category_name',
            'blog_title',
            'blog_slug',
            'short_description',
            'featured_image',
            'publish_date',
            'content',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'tags',
            'canonical_url',
        ]);

        $this->status = 'draft';
        $this->publish_type = 'instant';

        $this->redirect('/admin/blog');
    }
}