<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    public function index() {
        $withdrawals = $this->getTableData();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function setAsComplete(Request $request) {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        Withdrawal::where('id', $request->id)
            ->update([
                'date_time_completed' => Carbon::now()
            ]);

        $withdrawals = $this->getTableData();

        return response()->json([
            'content' => (string)view('admin.withdrawals.includes.withdrawalsTable', compact('withdrawals'))
        ]);
    }

    public function getTableData() {
        return Withdrawal::select('withdrawals.*', 'users.firstname', 'users.lastname')
            ->leftJoin('users', 'user_id', 'users.id')
            ->latest()
            ->get();
    }
}
