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
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class MigrateOldDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fairwin:migrate_old_database';

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

        $out->writeln('Migrating Conversions Table');
        $items = DB::table('fw_conversions')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'type' => $item->type,
                'gem' => $item->gem,
                'peso' => $item->peso,
                'fee_in_gems' => $item->fee_in_gems,
                'fee_in_pesos' => $item->fee_in_pesos,
                'created_at' => $item->date_time,
            ];
        }

//        Conversion::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            Conversion::insert($data);
//        }

        $out->writeln('Migrating Users Table');
        $users = DB::table('fw_accounts')->get();
        $newUsers = [];

        foreach($users as $user) {
            $newUsers[] = [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email_address,
                'contact_number' => $user->contact_number,
                'username' => $user->username,
                'password' => $user->password,
                'pin_code' => $user->pin_code,
                'referral_code' => $user->referral_code,
                'package_id' => $user->package_id,
                'sponsor' => $user->sponsor,
                'rank' => $user->rank,
                'stockist' => $user->stockist,
                'photo' => ($user->photo != '') ? $user->photo : null,
                'created_at' => $user->date_time_registered,
            ];
        }

//        User::truncate();
//        foreach(array_chunk($newUsers,1000) as $data) {
//            User::insert($data);
//        }

        $out->writeln('Migrating Downlines Table');
        $downlines = DB::table('fw_downlines')->get();
        $newDownlines = [];

        foreach($downlines as $downline) {
            $newDownlines[] = [
                'id' => $downline->id,
                'upline' => $downline->upline,
                'downline' => $downline->downline,
                'leg' => $downline->leg,
                'level' => $downline->level,
            ];
        }

//        Downline::truncate();
//        foreach(array_chunk($newDownlines,1000) as $data) {
//            Downline::insert($data);
//        }

        $out->writeln('Migrating Gem Purchases Table');
        $gemPurchases = DB::table('fw_gem_purchases')->get();
        $newGemPurchases = [];

        foreach($gemPurchases as $gemPurchase) {
            $newGemPurchases[] = [
                'id' => $gemPurchase->id,
                'user_id' => $gemPurchase->account_id,
                'amount' => $gemPurchase->amount,
                'price' => $gemPurchase->price,
                'proof_of_payment' => $gemPurchase->proof_of_payment,
                'created_at' => $gemPurchase->date_time_requested,
                'date_time_approved' => ($gemPurchase->date_time_approved != '0000-00-00 00:00:00') ? $gemPurchase->date_time_approved : null,
                'deleted_at' => ($gemPurchase->is_removed == 1) ? $gemPurchase->date_time_requested : null,
            ];
        }

//        GemPurchase::truncate();
//        foreach(array_chunk($newGemPurchases,1000) as $data) {
//            GemPurchase::insert($data);
//        }

        $out->writeln('Migrating Infinity Plus Incomes Table');
        $items = DB::table('fw_income_infinity_plus')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'upline' => $item->upline,
                'downline' => $item->downline,
                'level' => $item->level,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        InfinityPlusIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            InfinityPlusIncome::insert($data);
//        }

        $out->writeln('Migrating Personal Rebate Incomes Table');
        $items = DB::table('fw_income_personal_rebate')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'user_id' => $item->account_id,
                'amount' => $item->amount,
                'dream_maker_percentage' => $item->dream_maker_percentage,
                'created_at' => $item->date_time,
            ];
        }

//        PersonalRebateIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            PersonalRebateIncome::insert($data);
//        }

        $out->writeln('Migrating Pool Share Incomes Table');
        $items = DB::table('fw_income_pool_share')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'shares' => $item->shares,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        PoolShareIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            PoolShareIncome::insert($data);
//        }

        $out->writeln('Migrating Rank Incentive Incomes Table');
        $items = DB::table('fw_income_rank_incentive')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'rank' => $item->rank,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        RankIncentiveIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            RankIncentiveIncome::insert($data);
//        }

        $out->writeln('Migrating Referral Incomes Table');
        $items = DB::table('fw_income_referral')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'upline' => $item->upline,
                'downline' => $item->downline,
                'level' => $item->level,
                'amount' => $item->amount,
                'dream_maker_percentage' => $item->dream_maker_percentage,
                'created_at' => $item->date_time,
            ];
        }

//        ReferralIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            ReferralIncome::insert($data);
//        }

        $out->writeln('Migrating Royalty Bonus Incomes Table');
        $items = DB::table('fw_income_royalty_bonus')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'generation' => $item->generation,
                'downline' => $item->downline,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        RoyaltyBonusIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            RoyaltyBonusIncome::insert($data);
//        }

        $out->writeln('Migrating Stairstep Incomes Table');
        $items = DB::table('fw_income_stairstep')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'upline' => $item->upline,
                'downline' => $item->downline,
                'level' => $item->level,
                'amount' => $item->amount,
                'received' => $item->received,
                'created_at' => $item->date_time,
            ];
        }

//        StairstepIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            StairstepIncome::insert($data);
//        }

        $out->writeln('Migrating Unilevel Incomes Table');
        $items = DB::table('fw_income_unilevel')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'upline' => $item->upline,
                'downline' => $item->downline,
                'level' => $item->level,
                'amount' => $item->amount,
                'received' => $item->received,
                'dream_maker_percentage' => $item->dream_maker_percentage,
                'created_at' => $item->date_time,
            ];
        }

//        UnilevelIncome::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            UnilevelIncome::insert($data);
//        }

        $out->writeln('Migrating Items Table');
        $items = DB::table('fw_items')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'type' => $item->type,
                'package_id' => $item->package_id,
                'name' => $item->name,
                'center_price' => $item->center_price,
                'mobile_price' => $item->mobile_price,
                'distributors_price' => $item->distributors_price,
                'suggested_retail_price' => $item->suggested_retail_price,
                'points_value' => $item->points_value,
                'points_level_1' => $item->points_level_1,
                'points_level_2' => $item->points_level_2,
                'points_level_3' => $item->points_level_3,
                'points_level_4' => $item->points_level_4,
                'points_level_5' => $item->points_level_5,
                'points_level_6' => $item->points_level_6,
                'points_level_7' => $item->points_level_7,
                'points_level_8' => $item->points_level_8,
                'photo' => $item->photo,
                'status' => $item->status,
            ];
        }

//        Item::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            Item::insert($data);
//        }

        $out->writeln('Migrating Ordered Items Table');
        $items = DB::table('fw_ordered_items')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'order_id' => $item->order_id,
                'item_id' => $item->item_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'points_value' => $item->points_value,
            ];
        }

//        OrderedItem::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            OrderedItem::insert($data);
//        }

        $out->writeln('Migrating Orders Table');
        $items = DB::table('fw_orders')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'type' => $item->type,
                'stockist' => $item->stockist,
                'reference' => $item->reference,
                'user_id' => $item->account_id,
                'price' => $item->price,
                'points_value' => $item->points_value,
                'pool_share' => $item->pool_share,
                'full_name' => ($item->full_name == '') ? null : $item->full_name,
                'contact_number' => ($item->contact_number == '') ? null : $item->contact_number,
                'barangay' => ($item->barangay == '') ? null : $item->barangay,
                'city' => ($item->city == '') ? null : $item->city,
                'province' => ($item->province == '') ? null : $item->province,
                'zip_code' => ($item->zip_code == '') ? null : $item->zip_code,
                'terminal_user_id' => $item->terminal_account_id,
                'date_time_completed' => ($item->date_time_completed == '0000-00-00 00:00:00') ? null : $item->date_time_completed,
                'created_at' => $item->date_time_placed,
            ];
        }

//        Order::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            Order::insert($data);
//        }

        $out->writeln('Migrating Payout Information Table');
        $items = DB::table('fw_payout_information')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'method' => $item->method,
                'account_number' => ($item->account_number == '') ? null : $item->account_number,
                'account_name' => ($item->account_name == '') ? null : $item->account_name,
                'name' => ($item->name == '') ? null : $item->name,
                'mobile_number' => ($item->mobile_number == '') ? null : $item->mobile_number,
                'wallet_address' => ($item->wallet_address == '') ? null : $item->wallet_address,
            ];
        }

//        PayoutInformation::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            PayoutInformation::insert($data);
//        }

        $out->writeln('Migrating Pool Share Contribution Table');
        $items = DB::table('fw_pool_share_contributions')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        PoolShareContribution::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            PoolShareContribution::insert($data);
//        }

        $out->writeln('Migrating Rank Points Table');
        $items = DB::table('fw_rank_points')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'order_id' => $item->order_id,
                'points_value' => $item->points_value,
                'created_at' => $item->date_time,
            ];
        }

//        RankPoint::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            RankPoint::insert($data);
//        }

        $out->writeln('Migrating Stockist Assignments Table');
        $items = DB::table('fw_stockist_assignment')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'stockist' => $item->stockist,
                'assigned' => $item->assigned
            ];
        }

//        StockistAssignment::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            StockistAssignment::insert($data);
//        }

        $out->writeln('Migrating Transfers Table');
        $items = DB::table('fw_transfers')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'sender' => $item->sender,
                'receiver' => $item->receiver,
                'amount' => $item->amount,
                'created_at' => $item->date_time,
            ];
        }

//        Transfer::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            Transfer::insert($data);
//        }

        $out->writeln('Migrating Winners Gem Values Table');
        $items = DB::table('fw_winners_gem_value')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'percentage' => $item->percentage,
                'created_at' => $item->date_time,
            ];
        }

//        WinnersGemValue::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            WinnersGemValue::insert($data);
//        }

        $out->writeln('Migrating Withdrawals Table');
        $items = DB::table('fw_withdrawals')->get();
        $newItems = [];

        foreach($items as $item) {
            $newItems[] = [
                'id' => $item->id,
                'user_id' => $item->account_id,
                'amount' => $item->amount,
                'fee' => $item->fee,
                'payout_information' => $item->payout_information,
                'date_time_completed' => ($item->date_time_completed == '0000-00-00 00:00:00') ? null : $item->date_time_completed,
                'created_at' => $item->date_time_requested,
            ];
        }

//        Withdrawal::truncate();
//        foreach(array_chunk($newItems,1000) as $data) {
//            Withdrawal::insert($data);
//        }

        $out->writeln('Dropping Old Tables');

//        Schema::dropIfExists('fw_accounts');
//        Schema::dropIfExists('fw_admin');
//        Schema::dropIfExists('fw_conversions');
//        Schema::dropIfExists('fw_downlines');
//        Schema::dropIfExists('fw_gem_purchases');
//        Schema::dropIfExists('fw_genealogy');
//        Schema::dropIfExists('fw_income_infinity_plus');
//        Schema::dropIfExists('fw_income_personal_rebate');
//        Schema::dropIfExists('fw_income_pool_share');
//        Schema::dropIfExists('fw_income_rank_incentive');
//        Schema::dropIfExists('fw_income_referral');
//        Schema::dropIfExists('fw_income_royalty_bonus');
//        Schema::dropIfExists('fw_income_stairstep');
//        Schema::dropIfExists('fw_income_unilevel');
//        Schema::dropIfExists('fw_items');
//        Schema::dropIfExists('fw_ordered_items');
//        Schema::dropIfExists('fw_orders');
//        Schema::dropIfExists('fw_payout_information');
//        Schema::dropIfExists('fw_pool_share_contributions');
//        Schema::dropIfExists('fw_rank_points');
//        Schema::dropIfExists('fw_stockist_assignment');
//        Schema::dropIfExists('fw_transfers');
//        Schema::dropIfExists('fw_winners_gem_value');
//        Schema::dropIfExists('fw_withdrawals');

        return 0;
    }
}
