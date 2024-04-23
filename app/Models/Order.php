<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class Order extends Model
{
    use HasFactory;

    public function items() {
        return Item::select('items.*', 'ordered_items.price', 'ordered_items.quantity')
            ->join('ordered_items', 'items.id', 'ordered_items.item_id')
            ->join('orders', 'ordered_items.order_id', 'orders.id')
            ->where('orders.id', $this->id)
            ->get();
    }

    public function referralIncomes() {
        return $this->hasMany(ReferralIncome::class);
    }

    public function infinityPlusIncomes() {
        return $this->hasMany(InfinityPlusIncome::class);
    }

    public function unilevelIncomes() {
        return $this->hasMany(UnilevelIncome::class);
    }

    public function revert(ConsoleOutput $out = null) {
        if($out) {
            $out->writeln('');
            $out->writeln('Reverting Order ID: ' . $this->id);
        }

        DB::beginTransaction();

        if($out) {
            $out->writeln('Peso Balance: ' . User::find(26)->income()['pesoBalance']);
            $out->writeln('Winners Gem Balance: ' . User::find(26)->income()['gemBalance']);
            $out->writeln('Terminal Winners Gem: ' . User::find(26)->terminalWinnersGem()['balance']);
        }

        try {
            $order = $this;
            $user = $this->user;

            if($out) {
                $out->writeln('User ID: ' . $user['id']);
            }

            Order::where('id', $order['id'])
                ->delete();

            OrderedItem::where('order_id', $order['id'])
                ->delete();

            $user->is_dormant = ($user->maintainedMonthsOverSixMonths() >= 3) ? 0 : 1;
            $user->update();

            if($out) {
                $out->writeln('Order is Package: ' . (($order['type'] == 1) ? 'Yes' : 'No'));
            }

            // if order is a package, update the package id in users table to be the previous one
            if($order['type'] == 1) {
                $packageOrders = $user->orders()
                    ->where('type', 1)
                    ->latest()
                    ->get();

                $packages = packages();

                for($i = 0; $i < count($packageOrders); $i++) {
                    $packageId = $packageOrders[$i]->items()[0]['package_id'];

                    for($j = 0; $j < count($packages); $j++) {
                        if($packages[$j]['package_id'] == $packageId) {
                            $packages[$j]['availed'] = true;
                        }
                    }
                }

                $previousPackageId = 0;
                for($j = count($packages) - 1; $j >= 0; $j--) {
                    if($packages[$j]['availed']) {
                        $previousPackageId = $packages[$j]['package_id'];
                    }
                }

                $out->writeln('Previous Package ID: ' . $previousPackageId);

                $user->package_id = $previousPackageId;
                $user->update();
            }

            ReferralIncome::where('order_id', $order['id'])
                ->delete();

            InfinityPlusIncome::where('order_id', $order['id'])
                ->delete();

            PersonalRebateIncome::where('order_id', $order['id'])
                ->delete();

            UnilevelIncome::where('order_id', $order['id'])
                ->delete();

            StairstepIncome::where('order_id', $order['id'])
                ->delete();

            RankPoint::where('order_id', $order['id'])
                ->delete();

            $monthlyPVMaintenance = $user->monthlyPVMaintenance(Carbon::parse($order['date_time_completed'])->startOfMonth()->toDateTimeString());

            UnilevelIncome::where('upline', $user['id'])
                ->where('created_at', '>=', Carbon::parse($order['date_time_completed'])->format('Y-m-01 00:00:00'))
                ->where('created_at', '<=', Carbon::parse($order['date_time_completed'])->format('Y-m-t 23:59:59'))
                ->update([
                    'received' => ($monthlyPVMaintenance >= 100) ? 1 : 0
                ]);

            if(($user['rank'] >= 2 && $user['rank'] <= 5 && $monthlyPVMaintenance >= 200) || ($user['rank'] == 6 && $monthlyPVMaintenance >= 300) || ($user['rank'] >= 7 && $user['rank'] <= 9 && $monthlyPVMaintenance >= 500)) {
                StairstepIncome::where('upline', $user['id'])
                    ->where('created_at', '>=', Carbon::parse($order['date_time_completed'])->format('Y-m-01 00:00:00'))
                    ->where('created_at', '<=', Carbon::parse($order['date_time_completed'])->format('Y-m-t 23:59:59'))
                    ->update([
                        'received' => 1
                    ]);
            } else {
                StairstepIncome::where('upline', $user['id'])
                    ->where('created_at', '>=', Carbon::parse($order['date_time_completed'])->format('Y-m-01 00:00:00'))
                    ->where('created_at', '<=', Carbon::parse($order['date_time_completed'])->format('Y-m-t 23:59:59'))
                    ->update([
                        'received' => 0
                    ]);
            }

            $user->updateRank();

            $upline = User::select('users.*')
                ->join('downlines', function($join) use ($user) {
                    $join->on('users.id', 'upline');
                    $join->where('downline', $user['id']);
                    $join->where('level', 1);
                })
                ->first();

            while($upline) {
                $upline->updateRank();

                $upline = User::select('users.*')
                    ->join('downlines', function($join) use ($upline) {
                        $join->on('users.id', 'upline');
                        $join->where('downline', $upline['id']);
                        $join->where('level', 1);
                    })
                    ->first();
            }

            if($out) {
                $out->writeln('Peso Balance: ' . User::find(26)->income()['pesoBalance']);
                $out->writeln('Winners Gem Balance: ' . User::find(26)->income()['gemBalance']);
                $out->writeln('Terminal Winners Gem: ' . User::find(26)->terminalWinnersGem()['balance']);
            }

//            DB::commit();

            if($out) {
                $out->writeln('');
            }
        } catch (\Exception $e) {
            DB::rollback();
            $out->writeln($e->getMessage());
        }
    }

    public function stairstepIncomes() {
        return $this->hasMany(StairstepIncome::class);
    }

    public function orderedItems() {
        return $this->hasMany(OrderedItem::class);
    }

    public function personalRebateIncome() {
        return $this->hasMany(PersonalRebateIncome::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
