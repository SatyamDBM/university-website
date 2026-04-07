<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class LogoBrandingSettings extends Page
{
    use WithFileUploads;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Logo & Branding Settings';

    protected string $view = 'filament.pages.logo-branding-settings';

    public ?string $website_logo = null;
    public ?string $admin_logo = null;
    public ?string $favicon = null;
    public ?string $brand_name = null;
    public ?string $footer_text = null;

    public $website_logo_upload = null;
    public $admin_logo_upload = null;
    public $favicon_upload = null;

    public function mount(): void
    {
        $this->website_logo = $this->getSetting('website_logo');
        $this->admin_logo = $this->getSetting('admin_logo');
        $this->favicon = $this->getSetting('favicon');
        $this->brand_name = $this->getSetting('brand_name');
        $this->footer_text = $this->getSetting('footer_text');
    }

    public function save(): void
    {
        $this->validate([
            'website_logo_upload' => 'nullable|image|max:2048',
            'admin_logo_upload' => 'nullable|image|max:2048',
            'favicon_upload' => 'nullable|image|max:2048',
            'brand_name' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:1000',
        ]);

        if ($this->website_logo_upload) {
            if ($this->website_logo && Storage::disk('public')->exists(str_replace('storage/', '', $this->website_logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->website_logo));
            }

            $path = $this->website_logo_upload->store('logo', 'public');
            $this->website_logo = 'storage/' . $path;
        }

        if ($this->admin_logo_upload) {
            if ($this->admin_logo && Storage::disk('public')->exists(str_replace('storage/', '', $this->admin_logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->admin_logo));
            }

            $path = $this->admin_logo_upload->store('admin_logo', 'public');
            $this->admin_logo = 'storage/' . $path;
        }

        if ($this->favicon_upload) {
            if ($this->favicon && Storage::disk('public')->exists(str_replace('storage/', '', $this->favicon))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->favicon));
            }

            $path = $this->favicon_upload->store('favicon', 'public');
            $this->favicon = 'storage/' . $path;
        }

        $settings = [
            'website_logo' => $this->website_logo,
            'admin_logo' => $this->admin_logo,
            'favicon' => $this->favicon,
            'brand_name' => $this->brand_name,
            'footer_text' => $this->footer_text,
        ];

        foreach ($settings as $key => $value) {
            DB::table('general_settings')->updateOrInsert(
                [
                    'group' => 'branding',
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $this->website_logo_upload = null;
        $this->admin_logo_upload = null;
        $this->favicon_upload = null;

        Notification::make()
            ->title('Logo & branding settings saved successfully')
            ->success()
            ->send();
    }

    protected function getSetting(string $key): ?string
    {
        return DB::table('general_settings')
            ->where('group', 'branding')
            ->where('key', $key)
            ->value('value');
    }
}