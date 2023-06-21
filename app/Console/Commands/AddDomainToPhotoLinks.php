<?php

namespace App\Console\Commands;

use App\Models\Downline;
use App\Models\GemPurchase;
use App\Models\InfinityPlusIncome;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\PayoutInformation;
use App\Models\PersonalRebateIncome;
use App\Models\PoolShareContribution;
use App\Models\PoolShareIncome;
use App\Models\RankIncentiveIncome;
use App\Models\RankPoint;
use App\Models\ReferralIncome;
use App\Models\RoyaltyBonusIncome;
use App\Models\StairstepIncome;
use App\Models\StockistAssignment;
use App\Models\Transfer;
use App\Models\UnilevelIncome;
use App\Models\User;
use App\Models\WinnersGemValue;
use App\Models\Withdrawal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddDomainToPhotoLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fairwin:add_domain_to_photo_links';

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
        // Import first the old database

        $out = new ConsoleOutput();

        $out->writeln('Adding to domain to photo links');
        $items = Item::all();
        foreach($items as $item) {
            if($item['photo'] && !str_contains($item['photo'], 'https://') && !str_contains($item['photo'], 'http://')) {
                $item->photo = asset($item['photo']);
                $item->update();
            }
        }

        $users = User::all();
        foreach($users as $user) {
            if($user['photo'] && !str_contains($user['photo'], 'https://') && !str_contains($user['photo'], 'http://')) {
                $user->photo = asset($user['photo']);
                $user->update();
            }
        }

        return 0;
    }
}
