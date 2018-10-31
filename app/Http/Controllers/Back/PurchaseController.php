<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Purchase;
use App\Model\Vendor;
use App\Model\StbRecord;
use App\Model\Commission;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $uid = Auth::user()->id;
        $uname = Auth::user()->name;
        $list = Purchase::leftJoin('users', 'stb_purchase.user_id', '=', 'users.id')
                ->leftJoin('stb_record', 'stb_purchase.stb_id', '=', 'stb_record.stb_id')
                ->select('stb_purchase.*', 'stb_record.stb_no', 'users.name')
                ->where('stb_purchase.seller_id', $uid)
                ->orderBy('stb_purchase.purchase_date', 'desc')
                ->paginate(20);
        $count = Purchase::leftJoin('users', 'stb_purchase.user_id', '=', 'users.id')
                ->leftJoin('stb_record', 'stb_purchase.stb_id', '=', 'stb_record.stb_id')
                ->where('stb_purchase.seller_id', $uid)
                ->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;

        return view('back.purchase.index', compact('uname', 'list', 'count', 'pageno'));
    }

    public function create() {
        $action = 'Add';
        $uid = Auth::user()->id;
        $route = url('purchase');
        $stb = StbRecord::where('user_id', $uid)->where('stb_status', '1')->whereDate('expire_date', '<', date("Y-m-d"))->get();
        $user = Vendor::where('parent', $uid)->orderBy('name')->get();
        $today = date("Y-m-d");

        return view('back.purchase.create', compact('action', 'route', 'stb', 'user', 'uid', 'today'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $insert = Purchase::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        /*
         * commission calculation to follow
         */
        

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/purchase'));
    }
}
