<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\ConsoleOutput;

class CheckDormantUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fairwin:check_dormant_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $out = new ConsoleOutput();
        $out->writeln('Checking for Dormant Users');

        $users = User::latest()
            ->get();

        foreach($users as $user) {
            $out->writeln($user['id']);

            $user->is_dormant = $user->hasNoPurchaseFor180days() ? 1 : 0;
            $user->update();
        }

        return 0;
    }
}
