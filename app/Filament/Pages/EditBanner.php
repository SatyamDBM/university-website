<?php

namespace App\Filament\Pages;

use App\Models\Banner;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Str;

class EditBanner extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'edit-banner/{record}';

    protected string $view = 'filament.pages.edit-banner';

    public Banner $banner;

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

    public function mount($record): void
    {
        $this->banner = Banner::findOrFail($record);

        $this->name = $this->banner->name;
        $this->slot_name = $this->banner->slot_name;
        $this->placement_location = $this->banner->placement_location;
        $this->device_type = $this->banner->device_type;
        $this->image_width = $this->banner->image_width;
        $this->image_height = $this->banner->image_height;
        $this->monthly_price = $this->banner->monthly_price;
        $this->yearly_price = $this->banner->yearly_price;
        $this->display_priority = $this->banner->display_priority;
        $this->status = $this->banner->status;
    }

    public function updateBanner(): void
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

        while (
            Banner::where('slug', $slug)
                ->where('id', '!=', $this->banner->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $this->banner->update([
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
            ->title('Banner updated successfully')
            ->success()
            ->send();

        $this->redirect('/admin/all-banners');
    }
}