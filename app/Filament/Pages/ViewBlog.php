<?php

namespace App\Filament\Pages;

use App\Models\Blog;
use Filament\Pages\Page;

class ViewBlog extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.view-blog';

    public ?Blog $blog = null;

    public function mount(): void
    {
        $this->blog = Blog::with('detail')->findOrFail(request()->id);
    }
}