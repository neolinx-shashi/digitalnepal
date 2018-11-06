<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Deposit;
use App\Model\Vendor;

class DepositController extends Controller
{
    public function __construct() {
        $this->middleware('auth');

        $this->type = array(
            'D' => 'Device',
            'S' => 'Security',
            'T' => 'Top Up'
        );
    }

    public function index() {
        $userId = Auth::user()->id;
        $list = Deposit::leftJoin('users', 'deposit.user_id', '=', 'users.id')
            ->select('deposit.*', 'users.name')
            ->where('users.parent', $userId)
            ->orderBy('users.name', 'asc')
            ->orderBy('deposit.created_at', 'desc')
            ->paginate(30);
        $count = Deposit::count();

        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('/deposit');
        //$franchise = Vendor::where('type', 'F')->get();
        $franchise = Vendor::where('parent', $userId)->get();
        $type = $this->type;

        return view('back.deposit.index', compact('list', 'count', 'pageno', 'action', 'route', 'franchise', 'type'));
    }

    public function store(Request $request) {
        $data = $request->all();

        $insert = Deposit::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/deposit'));
    }

    public function edit($id) {
        $userId = Auth::user()->id;
        $list = Deposit::leftJoin('users', 'deposit.user_id', '=', 'users.id')
            ->select('deposit.*', 'users.name')
            ->where('users.parent', $userId)
            ->orderBy('users.name', 'asc')
            ->orderBy('deposit.created_at', 'desc')
            ->paginate(30);
        $count = Deposit::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Edit';
        $route = url('/deposit/' . $id);
        //$franchise = Vendor::where('type', 'F')->get();
        $franchise = Vendor::where('parent', $userId)->get();
        $type = $this->type;
        $detail = Deposit::leftJoin('users', 'deposit.user_id', '=', 'users.id')->select('deposit.*', 'users.name')->where('deposit.deposit_id', $id)->first();

        return view('back.deposit.index', compact('list', 'count', 'pageno', 'action', 'route', 'type', 'detail', 'franchise'));
    }

    public function update($id, Request $request) {
        $data = $request->all();

        $row = Deposit::find($id);
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
        return redirect(url('/deposit'));
    }
}
