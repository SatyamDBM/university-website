<?php

namespace App\Filament\Pages;

use App\Models\Package;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

class EditPackage extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'edit-package/{record}';

    protected string $view = 'filament.pages.edit-package';

    public Package $package;

    public $name = '';

    public $packageSlug = '';

    public $description = '';

    public $price = '';

    public $duration = '';

    public $duration_type = 'months';

    public $status = 'active';

    public function mount($record): void
    {
        $this->package = Package::findOrFail($record);

        $this->name = $this->package->name;
        $this->packageSlug = $this->package->slug;
        $this->description = $this->package->description;
        $this->price = $this->package->price;
        $this->duration = $this->package->duration;
        $this->duration_type = $this->package->duration_type;
        $this->status = $this->package->status;
    }

    public function updatePackage(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'packageSlug' => [
                'nullable',
                'string',
                'max:255',
                'unique:packages,slug,' . $this->package->id,
            ],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'duration_type' => ['required', 'in:days,months,years'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $slug = filled($this->packageSlug)
            ? Str::slug($this->packageSlug)
            : Str::slug($this->name);

        $this->package->update([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_type' => $this->duration_type,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Package updated successfully')
            ->success()
            ->send();
        $this->redirect('/admin/all-packages');
    }
}