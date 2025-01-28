<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;


class unactivateExpiredUsers extends Command
{
    public function handle()
        {
            User::where('activated_at', '<', Carbon::now()->subYear())
                ->update(['is_active' => 'false'])->update(['activated_at' => null]);

            $this->info('Oude gebruikers zijn gedeactiveerd.');
        }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:unactivate-expired-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

}
