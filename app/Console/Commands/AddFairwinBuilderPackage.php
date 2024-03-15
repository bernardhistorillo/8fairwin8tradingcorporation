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

class AddFairwinBuilderPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fairwin:add_fairwin_builder_package';

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



        $item = Item::where('package_id', 7)
            ->first();

        if(!$item) {
            $item = new Item();
            $item->type = 1;
            $item->package_id = 7;
            $item->name = 'Fairwin Builder Package';
            $item->center_price = 5830;
            $item->mobile_price = 5905;
            $item->distributors_price = 5980;
            $item->suggested_retail_price = 5980;
            $item->points_value = 100;
            $item->points_level_1 = 500;
            $item->points_level_2 = 20;
            $item->points_level_3 = 20;
            $item->points_level_4 = 20;
            $item->points_level_5 = 20;
            $item->points_level_6 = 10;
            $item->points_level_7 = 10;
            $item->points_level_8 = 10;
            $item->photo = 'https://8fairwin8tradingcorp.com/img/items/FBP5980.png';
            $item->dimension = '[925,527]';
            $item->status = 1;
            $item->save();
        }

        $out->writeln('Fairwin Builder Package successfully added!');

        return 0;
    }
}
