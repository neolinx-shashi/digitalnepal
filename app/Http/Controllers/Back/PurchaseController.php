<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Purchase;
use App\Model\Vendor;
use App\Model\StbRecord;
use App\Model\Commission;
use App\Model\CommissionRate;
use App\Model\Price;
use App\Model\Package;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->today = date('Y-m-d');
    }

    public function index() {
        $uid = Auth::user()->id;
        $uname = Auth::user()->name;
        $list = Purchase::leftJoin('users', 'stb_purchase.user_id', '=', 'users.id')
                ->leftJoin('stb_record', 'stb_purchase.stb_id', '=', 'stb_record.stb_id')
                ->leftJoin('stb', 'stb_purchase.stb_id', '=', 'stb.stb_id')
                ->leftJoin('package', 'stb_purchase.package_id', '=', 'package.package_id')
                ->select('stb_purchase.*', 'stb_record.stb_no', 'users.name', 'stb.stb_number', 'package.package_name')
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
        //$stb = StbRecord::where('user_id', $uid)->where('stb_status', '1')->whereDate('expire_date', '<', date("Y-m-d"))->get();
        $stb = StbRecord::leftJoin('stb', 'stb_record.stb_no', '=', 'stb.stb_id')
                ->select('stb.stb_id', 'stb.stb_number')
                ->where('stb_record.stb_status', '1')
                ->whereDate('stb_record.expire_date', '>=', $this->today)
                ->where('stb_record.user_id', $uid)
                ->get();

        $registered_stb = Purchase::where('seller_id', $uid)->get();

        foreach ($stb as $key => $val) {
            foreach ($registered_stb as $reg) {
                if ($reg->stb_id == $val->stb_id) {
                    unset($stb[$key]);
                }
            }
        }

        $user = Vendor::where('parent', $uid)->orderBy('name')->get();
        $today = date("Y-m-d");

        $package = Package::orderBy('package_name', 'asc')->get();

        return view('back.purchase.create', compact('action', 'route', 'stb', 'user', 'uid', 'today', 'package'));
    }

    public function store(Request $request) {
        $userId = Auth::user()->id;
        $data = $request->all();
        $insert = Purchase::create($data);
        $purchase_id = $insert->purchase_id;
        $id = $data['user_id'];
        $package_id = $data['package_id'];

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
        $distributor_id = Auth::user()->parent;
        if ($distributor_id != 0) {
            $distributor = Vendor::where('id', $distributor_id)->first();
            $franchisee_id = $distributor->parent;
            //$franchisee = Vendor::where('id', $franchisee_id)->first();

            /*
             * get commission rate
             */
            //$amount = Price::distinct('price_type')->orderBy('created_at', 'desc')->sum('price_rate');
            $amount = Package::where('package_id', $package_id)->sum('package_price');
            $vat = 0; // need to change
            $after_vat = $amount - $vat;
            $commission_rate = CommissionRate::distinct('user_type')->select('rate_percent', 'user_type')->orderBy('created_at', 'desc')->get();

            foreach ($commission_rate as $val) {
                $type = $val->user_type;
                $percent = $val->rate_percent;
                $commission = $percent / 100 * $after_vat;
                $user_id = 0;
                $commission_from = 0;
                if ($type == 'S') {
                    $commission_from = $id;
                    $user_id = $userId;
                } else if ($type == 'D') {
                    $commission_from = $userId;
                    $user_id = $distributor_id;
                } else if ($type == 'F') {
                    $commission_from = $distributor_id;
                    $user_id = $franchisee_id;
                } else if ($type == 'A') {
                    $commission_from = $franchisee_id;
                    $user_id = '1';
                }

                $insert_commission = Commission::insert(['user_id' => $user_id, 'commission_amount' => $commission, 'commission_from' => $commission_from, 'purchase_id' => $purchase_id]);
            }
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/purchase'));
    }
}
