<?php

namespace App\Services;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;


// class MailConfigurationService
// {
// public static function setMailConfig(): void
// {
//     Config::set('mail.default', GeneralSetting::where('key', 'mail_driver')->value('value') ?: 'smtp');

//     Config::set('mail.mailers.smtp.transport', 'smtp');

//     Config::set('mail.mailers.smtp.host', GeneralSetting::where('key', 'mail_host')->value('value'));

//     Config::set('mail.mailers.smtp.port', GeneralSetting::where('key', 'mail_port')->value('value'));

//     Config::set('mail.mailers.smtp.encryption', GeneralSetting::where('key', 'mail_encryption')->value('value'));

//     Config::set('mail.mailers.smtp.username', GeneralSetting::where('key', 'mail_username')->value('value'));

//     Config::set('mail.mailers.smtp.password', GeneralSetting::where('key', 'mail_password')->value('value'));

//     Config::set('mail.from.address', GeneralSetting::where('key', 'mail_from_address')->value('value'));

//     Config::set('mail.from.name', GeneralSetting::where('key', 'mail_from_name')->value('value'));
// }
// }




class MailConfigurationService
{
    public static function setMailConfig(): void
    {
        // ✅ Prevent crash during migration
        if (!Schema::hasTable('general_settings')) {
            return;
        }

        // ✅ Fetch all settings in ONE query (performance fix)
        $settings = GeneralSetting::pluck('value', 'key');

        Config::set('mail.default', $settings['mail_driver'] ?? 'smtp');

        Config::set('mail.mailers.smtp.transport', 'smtp');
        Config::set('mail.mailers.smtp.host', $settings['mail_host'] ?? null);
        Config::set('mail.mailers.smtp.port', $settings['mail_port'] ?? null);
        Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption'] ?? null);
        Config::set('mail.mailers.smtp.username', $settings['mail_username'] ?? null);
        Config::set('mail.mailers.smtp.password', $settings['mail_password'] ?? null);

        Config::set('mail.from.address', $settings['mail_from_address'] ?? null);
        Config::set('mail.from.name', $settings['mail_from_name'] ?? null);
    }
}
