<?php

namespace App\Filament\Pages;

use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

class EditUniversityCategory extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'edit-university-category/{record}';

    protected string $view = 'filament.pages.edit-university-category';

    public Category $category;

    public $name = '';

    public $description = '';

    public $status = 'active';

    public function mount($record): void
    {
        $this->category = Category::findOrFail($record);

        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->status = $this->category->status;
    }

    public function updateCategory(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $count = 1;

        while (
            Category::where('slug', $slug)
                ->where('id', '!=', $this->category->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $this->category->update([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Category updated successfully')
            ->success()
            ->send();

        $this->redirect('/admin/university-categories');
    }
}