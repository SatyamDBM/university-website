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

    public $slot_name = '';

    public $placement_page = '';

    public $device_type = 'all';

    public $width = '';

    public $height = '';

    public $max_banner_limit = 1;

    public $rotation_type = '';

    public $priority = '';

    public $price = '';

    public $duration = '';

    public $duration_type = '';

    public $status = 'active';

    public $description = '';

    public function mount($record): void
    {
        $this->banner = Banner::findOrFail($record);

        $this->slot_name = $this->banner->slot_name;
        $this->placement_page = $this->banner->placement_location;
        $this->device_type = $this->banner->device_type;
        $this->width = $this->banner->width;
        $this->height = $this->banner->height;
        $this->max_banner_limit = $this->banner->max_banner_limit;
        $this->rotation_type = $this->banner->rotation_type;
        $this->priority = $this->banner->priority;
        $this->price = $this->banner->price;
        $this->duration = $this->banner->duration;
        $this->duration_type = $this->banner->duration_type;
        $this->status = $this->banner->status;
        $this->description = $this->banner->description;
    }

    public function updateBanner(): void
    {
        $this->validate([
            'slot_name' => [
                'required',
                'string',
                'max:255',
            ],

            'placement_page' => [
                'required',
                'in:homepage,search_page,listing_page,course_detail_page,university_detail_page,blog_page',
            ],

            'device_type' => [
                'required',
                'in:desktop,mobile,tablet,all',
            ],

            'width' => [
                'nullable',
                'integer',
            ],

            'height' => [
                'nullable',
                'integer',
            ],

            'max_banner_limit' => [
                'required',
                'integer',
                'min:1',
            ],

            'rotation_type' => [
                'required',
                'in:single_banner,random_rotation,slider_rotation',
            ],

            'priority' => [
                'required',
                'in:high,medium,low',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'duration' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'duration_type' => [
                'nullable',
                'in:days,months,years',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $baseSlug = Str::slug($this->slot_name);
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
            'name' => $this->slot_name,
            'slug' => $slug,
            'slot_name' => $this->slot_name,
            'placement_location' => $this->placement_page,
            'device_type' => $this->device_type,
            'width' => $this->width ?: null,
            'height' => $this->height ?: null,
            'max_banner_limit' => $this->max_banner_limit,
            'rotation_type' => $this->rotation_type,
            'priority' => $this->priority,
            'price' => $this->price,
            'duration' => $this->duration ?: null,
            'duration_type' => $this->duration_type ?: null,
            'status' => $this->status,
            'description' => $this->description,
        ]);

        Notification::make()
            ->title('Banner updated successfully')
            ->success()
            ->send();

        $this->redirect('/admin/all-banners');
    }
}