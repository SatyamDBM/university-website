<?php

namespace App\Filament\Pages;

use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class CreateUniversityCategory extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Categories';

    protected static ?string $navigationLabel = 'Create Category';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.create-university-category';

    public $name = '';

    public $description = '';

    public $status = 'active';

    public function createCategory(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        Category::create([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Category created successfully')
            ->success()
            ->send();

        $this->reset([
            'name',
            'description',
        ]);

        $this->status = 'active';

        $this->redirect('/admin/university-categories');
    }
}