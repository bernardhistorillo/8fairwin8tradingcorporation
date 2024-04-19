<?php

namespace App\Console\Commands;

use App\Models\Conversion;
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
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class RevertOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:revert {orderId}';

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

        $orderId = $this->argument('orderId');
        $order = Order::find($orderId);

        if(!$order) {
            $out->writeln('');
            $out->writeln('Invalid Order: ' . $orderId);

            return 0;
        }

        $order->revert($out);

        return 0;
    }
}
