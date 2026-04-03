<?php

namespace App\Filament\Pages;

use App\Models\Banner;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

class CreateBanner extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.create-banner';

    public $name = '';

    public $slot_name = '';

    public $placement_location = '';

    public $device_type = 'both';

    public $image_width = '';

    public $image_height = '';

    public $monthly_price = '';

    public $yearly_price = '';

    public $display_priority = 0;

    public $status = 'active';

    public function createBanner(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'slot_name' => ['required', 'in:homepage_top_banner,homepage_slider_banner,listing_page_banner,search_page_banner,blog_page_banner'],
            'placement_location' => ['required', 'in:homepage,listing_page,search_page,blog_page'],
            'device_type' => ['required', 'in:desktop,mobile,both'],
            'image_width' => ['nullable', 'integer'],
            'image_height' => ['nullable', 'integer'],
            'monthly_price' => ['required', 'numeric'],
            'yearly_price' => ['required', 'numeric'],
            'display_priority' => ['nullable', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $count = 1;

        while (Banner::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        Banner::create([
            'name' => $this->name,
            'slug' => $slug,
            'slot_name' => $this->slot_name,
            'placement_location' => $this->placement_location,
            'device_type' => $this->device_type,
            'image_width' => $this->image_width,
            'image_height' => $this->image_height,
            'monthly_price' => $this->monthly_price,
            'yearly_price' => $this->yearly_price,
            'display_priority' => $this->display_priority,
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Banner created successfully')
            ->success()
            ->send();

        $this->reset([
            'name',
            'slot_name',
            'placement_location',
            'image_width',
            'image_height',
            'monthly_price',
            'yearly_price',
        ]);

        $this->device_type = 'both';
        $this->display_priority = 0;
        $this->status = 'active';

        $this->redirect('/admin/all-banners');
    }
}