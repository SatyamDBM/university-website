<?php

namespace App\Services;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;

class MailConfigurationService
{
    public static function setMailConfig(): void
    {
        Config::set('mail.default', GeneralSetting::where('key', 'mail_driver')->value('value') ?: 'smtp');

        Config::set('mail.mailers.smtp.transport', 'smtp');

        Config::set('mail.mailers.smtp.host', GeneralSetting::where('key', 'mail_host')->value('value'));

        Config::set('mail.mailers.smtp.port', GeneralSetting::where('key', 'mail_port')->value('value'));

        Config::set('mail.mailers.smtp.encryption', GeneralSetting::where('key', 'mail_encryption')->value('value'));

        Config::set('mail.mailers.smtp.username', GeneralSetting::where('key', 'mail_username')->value('value'));

        Config::set('mail.mailers.smtp.password', GeneralSetting::where('key', 'mail_password')->value('value'));

        Config::set('mail.from.address', GeneralSetting::where('key', 'mail_from_address')->value('value'));

        Config::set('mail.from.name', GeneralSetting::where('key', 'mail_from_name')->value('value'));
    }
}