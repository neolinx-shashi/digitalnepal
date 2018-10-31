<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Vendor;
use App\Model\Wallet;
use App\Model\Deposit;

class WalletController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::user()->id;
        $list = Wallet::leftJoin('users', 'wallet.wallet_to', '=', 'users.id')
            ->select('wallet.*', 'users.name')
            ->where('wallet.wallet_from', $userId)
            ->orderBy('wallet.created_at', 'desc')
            ->paginate(30);

        $count = Wallet::where('wallet_from', $userId)->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('/wallet');
        $subordinate = Vendor::where('parent', $userId)->orderBy('name', 'asc')->get();

        $remaining = $this->checkDeposit($userId);

        return view('back.wallet.index', compact('list', 'count', 'pageno', 'action', 'route', 'subordinate', 'userId', 'remaining'));
    }

    public function store(Request $request) {
        $data = $request->all();

        $insert = Wallet::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/wallet'));
    }

    public function edit($id) {
        $userId = Auth::user()->id;
        $list = Wallet::leftJoin('users', 'wallet.wallet_to', '=', 'users.id')
            ->select('wallet.*', 'users.name')
            ->where('wallet.wallet_from', $userId)
            ->orderBy('wallet.created_at', 'desc')
            ->paginate(30);

        $count = Wallet::where('wallet_from', $userId)->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Edit';
        $route = url('/wallet/' . $id);
        $subordinate = Vendor::where('parent', $userId)->orderBy('name', 'asc')->get();
        $detail = Wallet::leftJoin('users', 'wallet.wallet_to', '=', 'users.id')
            ->select('wallet.*', 'users.name')
            ->first();
        $remaining = $this->checkDeposit($userId);

        return view('back.wallet.index', compact('list', 'count', 'pageno', 'action', 'route', 'subordinate', 'userId', 'detail', 'remaining'));
    }

    public function update($id, Request $request) {
        $data = $request->all();

        $row = Wallet::find($id);
        $update = $row->fill($data)->save();

        if ($update) {
            $message = 'Data Update Success.';
            $stat = 1;
        } else {
            $message = 'Data Update Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/wallet'));
    }

    public function checkDeposit($id) {
        $deposit = Deposit::where('user_id', $id)->where('deposit_type', 'T')->sum('deposit_amount');
        $wallet = Wallet::where('wallet_from', $id)->sum('wallet_amount');
        $remaining = $deposit - $wallet;
        return $remaining;
    }
}
