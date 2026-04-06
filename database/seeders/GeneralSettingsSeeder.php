<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GeneralSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $settings = [
            [
                'group' => 'smtp',
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_port',
                'value' => '587',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_username',
                'value' => 'oohappio@gmail.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_password',
                'value' => 'skpcmoxdrxlzvnoh',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_encryption',
                'value' => 'tls',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_from_address',
                'value' => 'oohappio@gmail.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group' => 'smtp',
                'key' => 'mail_from_name',
                'value' => 'University',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('general_settings')->insert($settings);
    }
}