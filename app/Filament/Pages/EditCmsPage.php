<?php

namespace App\Filament\Pages;

use App\Models\CmsPage;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class EditCmsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Edit CMS Page';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit CMS Page';

    protected string $view = 'filament.pages.edit-cms-page';

    public ?CmsPage $cmsPage = null;

    public $cms_page_id;
    public $page_title = '';
    public $page_slug = '';
    public $content = '';
    public $seo_title = '';
    public $seo_description = '';
    public $is_active = 1;

    public function mount(): void
    {
        $id = request()->query('id');

        $this->cmsPage = CmsPage::findOrFail($id);

        $this->cms_page_id = $this->cmsPage->id;
        $this->page_title = $this->cmsPage->title;
        $this->page_slug = $this->cmsPage->slug;
        $this->content = $this->cmsPage->content;
        $this->seo_title = $this->cmsPage->seo_title;
        $this->seo_description = $this->cmsPage->seo_description;
        $this->is_active = $this->cmsPage->is_active;
    }

    public function updatedPageTitle(): void
    {
        $this->page_slug = Str::slug($this->page_title);
    }

    public function updateCmsPage(): void
    {
        $this->validate([
            'page_title'      => ['required', 'string', 'max:255'],
            'page_slug'       => ['required', 'string', 'max:255', 'unique:cms_pages,slug,' . $this->cms_page_id],
            'content'         => ['nullable', 'string'],
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'is_active'       => ['required', 'boolean'],
        ]);

        $this->cmsPage->update([
            'title'           => $this->page_title,
            'slug'            => $this->page_slug,
            'content'         => $this->content,
            'seo_title'       => $this->seo_title,
            'seo_description' => $this->seo_description,
            'is_active'       => $this->is_active,
        ]);

        Notification::make()
            ->title('CMS page updated successfully')
            ->success()
            ->send();
        $this->redirect('/admin/all-cms-pages');

    }
}