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

    public $description = '';

    public $price = '';

    public $duration = '';

    public $duration_type = 'months';

    public $coverage_type = 'city_level';

    public $status = 'active';

    public function createPackage(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'duration_type' => ['required', 'in:days,months,years'],
            'coverage_type' => ['required', 'in:city_level,state_level,multi_city,national'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $slug = Str::slug($this->name);

        Package::create([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_type' => $this->duration_type,
            'coverage_type' => $this->coverage_type,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Package created successfully')
            ->success()
            ->send();

        $this->reset([
            'name',
            'description',
            'price',
            'duration',
        ]);

        $this->duration_type = 'months';
        $this->coverage_type = 'city_level';
        $this->status = 'active';

        $this->redirect('/admin/all-packages');
    }
}