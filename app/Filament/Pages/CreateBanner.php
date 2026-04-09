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

    public function createBanner(): void
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

        while (Banner::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        Banner::create([
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
            ->title('Banner created successfully')
            ->success()
            ->send();

        $this->reset([
            'slot_name',
            'placement_page',
            'width',
            'height',
            'rotation_type',
            'priority',
            'price',
            'duration',
            'duration_type',
            'description',
        ]);

        $this->device_type = 'all';
        $this->max_banner_limit = 1;
        $this->status = 'active';

        $this->redirect('/admin/all-banners');
    }
}