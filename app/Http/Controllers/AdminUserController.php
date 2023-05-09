<?php

namespace App\Http\Controllers;

use App\Models\StockistAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request) {
        $stockist = ($request->stockist) ?? null;

        $users = $this->getUsers($stockist);

        return view('admin.users.index', compact('users', 'stockist'));
    }

    public function setStockist(Request $request) {
        $request->validate([
            'userId' => 'required|integer',
            'stockist' => 'required|integer',
        ]);

        User::where('id', $request->userId)
            ->update([
                'stockist' => $request->stockist
            ]);

        if($request->stockist == 1) {
            $request->validate([
                'centerStockist' => 'required|integer',
            ]);

            $stockistAssignment = StockistAssignment::where('assigned', $request->userId)
                ->first();

            if(!$stockistAssignment) {
                $stockistAssignment = new StockistAssignment();
                $stockistAssignment->stockist = $request->centerStockist;
                $stockistAssignment->assigned = $request->userId;
                $stockistAssignment->save();
            } else {
                $stockistAssignment->stockist = $request->centerStockist;
                $stockistAssignment->update();
            }
        }

        $stockist = ($request->view) ?? null;

        $users = $this->getUsers($stockist);

        return response()->json([
            'content' => (string)view('admin.users.includes.usersTable', compact('users', 'stockist'))
        ]);
    }

    public function getUsers($stockist) {
        $users = User::all();

        foreach($users as $user) {
            if($stockist == null || ($user["stockist"] == $stockist)) {
                $user['centerStockist'] = User::select('users.*')
                    ->join('stockist_assignments', function($join) use ($user) {
                        $join->on('users.id', 'stockist_assignments.stockist');
                        $join->where('assigned', $user["id"]);
                    })
                    ->first();
            }
        }

        return $users;
    }

    public function accessUser($userId) {
        Auth::loginUsingId($userId);
        return redirect()->route('dashboard.index');
    }
}
