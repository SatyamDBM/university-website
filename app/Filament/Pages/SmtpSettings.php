<?php

namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use UnitEnum;

class SmtpSettings extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-envelope';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'General Settings';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'general-settings/smtp-settings';

    protected string $view = 'filament.pages.smtp-settings';

    public $mail_driver;
    public $mail_host;
    public $mail_port;
    public $mail_encryption;
    public $mail_username;
    public $mail_password;
    public $mail_from_address;
    public $mail_from_name;

    public function mount(): void
    {
        $this->mail_driver = GeneralSetting::where('key', 'mail_driver')->value('value');
        $this->mail_host = GeneralSetting::where('key', 'mail_host')->value('value');
        $this->mail_port = GeneralSetting::where('key', 'mail_port')->value('value');
        $this->mail_encryption = GeneralSetting::where('key', 'mail_encryption')->value('value');
        $this->mail_username = GeneralSetting::where('key', 'mail_username')->value('value');
        $this->mail_password = GeneralSetting::where('key', 'mail_password')->value('value');
        $this->mail_from_address = GeneralSetting::where('key', 'mail_from_address')->value('value');
        $this->mail_from_name = GeneralSetting::where('key', 'mail_from_name')->value('value');
    }

    public function save(): void
    {
        $settings = [
            'mail_driver' => $this->mail_driver,
            'mail_host' => $this->mail_host,
            'mail_port' => $this->mail_port,
            'mail_encryption' => $this->mail_encryption,
            'mail_username' => $this->mail_username,
            'mail_password' => $this->mail_password,
            'mail_from_address' => $this->mail_from_address,
            'mail_from_name' => $this->mail_from_name,
        ];

        foreach ($settings as $key => $value) {
            GeneralSetting::updateOrCreate(
                ['key' => $key],
                [
                    'group' => 'smtp',
                    'value' => $value,
                ]
            );
        }

        Notification::make()
        ->title('SMTP settings updated successfully.')
        ->success()
        ->seconds(4)
        ->send();
    }
}