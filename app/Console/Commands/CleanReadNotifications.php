<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\User;

class CleanReadNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up read notifications older than a certain period';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Define the threshold for notifications to be cleaned
        $threshold = Carbon::now()->subDays(1);

        // Fetch users who have read notifications
        $users = User::whereHas('notifications', function ($query) use ($threshold) {
            $query->where('read_at', '<=', $threshold);
        })->get();

        // Iterate over users and clean their read notifications
        foreach ($users as $user) {
            $user->notifications()->where('read_at', '<=', $threshold)->delete();
        }

        $this->info('Read notifications cleaned successfully.');
    }
}
