<?php

namespace App\Filament\Pages;

use App\Models\Package;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class CreatePackage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Subscriptions';

    protected static ?string $navigationLabel = 'Create Package';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.create-package';

    public $name = '';

    public $packageSlug = '';

    public $description = '';

    public $price = '';

    public $duration = '';

    public $duration_type = 'months';

    public $status = 'active';

    public function createPackage(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'packageSlug' => ['nullable', 'string', 'max:255', 'unique:packages,slug'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'duration_type' => ['required', 'in:days,months,years'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $slug = filled($this->packageSlug)
            ? Str::slug($this->packageSlug)
            : Str::slug($this->name);

        Package::create([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_type' => $this->duration_type,
            'featured_listing' => 0,
            'homepage_visibility' => 0,
            'lead_access' => 1,
            'lead_limit' => 0,
            'banner_limit' => 0,
            'course_limit' => 0,
            'city_limit' => 0,
            'state_limit' => 0,
            'support_type' => 'Basic Support',
            'priority_rank' => 0,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Package created successfully')
            ->success()
            ->send();

        $this->reset([
            'name',
            'packageSlug',
            'description',
            'price',
            'duration',
        ]);

        $this->duration_type = 'months';
        $this->status = 'active';
        $this->redirect('/admin/all-packages');
    }
}