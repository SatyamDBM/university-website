<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UniversityBanner;

class ExpireBanners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-banners';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UniversityBanner::where('live_status', 'active')
            ->where('end_date', '<', now())
            ->update(['live_status' => 'expired']);

        return 0;
    }
}
