<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Vendor;
use App\Model\Wallet;
use App\Model\Deposit;
use App\Model\Commission;
use App\Model\CommissionRate;

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
        $pId = $insert->wallet_id;

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        /*
         * Commission
         */
        $type = Auth::user()->type;
        if ($type == 'S') {
            $this->commissionCalculations($pId, $data['wallet_to'], $data['wallet_amount']);
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

    public function commissionCalculations($pId, $uid, $amount) {
        $userId = Auth::user()->id; // sub-distributor id
        $distributor_id = Auth::user()->parent(); // distributor id
        $distributor_detail = Vendor::where('id', $distributor_id)->select('parent')->first();
        $franchisee_id = $distributor_detail->parent; // franchisee id

        /*
         * get commission rate
         */
        $vat = 0;
        $after_vat = $amount - $vat;
        $commission_rate = CommissionRate::get();
        foreach ($commission_rate as $val) {
            $type = $val->user_type;
            $percent = $val->rate_percent;
            $commission = $percent / 100 * $after_vat;

            if ($type == 'S') {
                $user_id = $userId;
                $commission_from = $uid;
            } elseif ($type == 'D') {
                $user_id = $distributor_id;
                $commission_from = $userId;
            } elseif ($type == 'F') {
                $user_id = $franchisee_id;
                $commission_from = $distributor_id;
            } elseif ($type == 'A') {
                $user_id = '1';
                $commission_from = $franchisee_id;
            }

            Commission::insert([
                'user_id' => $user_id,
                'commission_amount' => $commission,
                'commission_from' => $commission_from,
                'purchase_id' => $pId,
                'purchase_type' => 'T'
            ]);
        }
    }
}
