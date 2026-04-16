<?php

namespace App\Filament\Pages;

use App\Models\CmsPage;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class CreateCmsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Create CMS Page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Create CMS Page';

    protected string $view = 'filament.pages.create-cms-page';

    public $page_title = '';
    public $page_slug = '';
    public $content = '';
    public $seo_title = '';
    public $seo_description = '';
    public $is_active = 1;

    public function updatedPageTitle(): void
    {
        $this->page_slug = Str::slug($this->page_title);
    }

    public function createCmsPage(): void
    {
        $this->validate([
            'page_title'      => ['required', 'string', 'max:255'],
            'page_slug'       => ['required', 'string', 'max:255', 'unique:cms_pages,slug'],
            'content'         => ['nullable', 'string'],
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'is_active'       => ['required', 'boolean'],
        ]);

        CmsPage::create([
            'title'           => $this->page_title,
            'slug'            => $this->page_slug,
            'content'         => $this->content,
            'seo_title'       => $this->seo_title,
            'seo_description' => $this->seo_description,
            'is_active'       => $this->is_active,
        ]);

        Notification::make()
            ->title('CMS page created successfully')
            ->success()
            ->send();
        $this->redirect('/admin/all-cms-pages');

        $this->reset([
            'page_title',
            'page_slug',
            'content',
            'seo_title',
            'seo_description',
        ]);

        $this->is_active = 1;

    }
}