<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Model\Vendor;

class VendorController extends Controller
{
    protected $t;

    public function __construct() {
        $this->middleware('auth');

        $this->type = array(
            'A' => 'Superadmin',
            'F' => 'Franchise',
            'D' => 'Distributor',
            'S' => 'Sub Distributor',
            'R' => 'Subscriber',
            'G' => 'Agent'
        );

        $this->middleware(function ($request, $next) {
            $this->t = Auth::user()->type;

            if ($this->type == 'F') {
                $this->type = array(
                    'D' => 'Distributor',
                    'S' => 'Sub Distributor',
                    'R' => 'Subscriber'
                );
            } else if ($this->type == 'D') {
                $this->type = array(
                    'S' => 'Sub Distributor',
                    'R' => 'Subscriber'
                );
            } else if ($this->type == 'S' || $this->type == 'G') {
                $this->type = array(
                    'R' => 'Subscriber'
                );
            }

            return $next($request);
        });


    }

    public function index() {
        $userId = Auth::user()->id;
        $list = Vendor::where('parent', $userId)
                ->orderBy('type', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(20);
        $count = Vendor::where('parent', $userId)->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('/vendor');
        $type = $this->type;

        return view('back.vendor.index', compact('list', 'count', 'pageno', 'action', 'route', 'type'));
    }

    public function list($t) {
        if ($t == '0') {
            return redirect('vendor');
        }
        $userId = Auth::user()->id;
        $list = Vendor::where('parent', $userId)
            ->where('type', $t)
            ->orderBy('type', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(20);
        $count = Vendor::where('parent', $userId)->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('/vendor');
        $type = $this->type;

        return view('back.vendor.index', compact('list', 'count', 'pageno', 'action', 'route', 'type', 't'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['parent'] = Auth::user()->id;

        $insert = Vendor::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/vendor'));
    }

    public function edit($id) {
        $list = Vendor::orderBy('name', 'asc')->where('type', '!=', 'A')->paginate(20);
        $count = Vendor::where('type', '!=', 'A')->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Edit';
        $route = url('/vendor/' . $id);
        $type = $this->type;
        $detail = Vendor::find($id);

        return view('back.vendor.index', compact('list', 'count', 'pageno', 'action', 'route', 'type', 'detail'));
    }

    public function update($id, Request $request) {
        $data = $request->all();
        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $row = Vendor::find($id);
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
        return redirect(url('/vendor'));
    }

    public function destroy($id, Request $request) {
        $delete = Vendor::where('id', $id)->delete();

        if ($delete) {
            $message = 'Data Deleted Success.';
            $stat = 1;
        } else {
            $message = 'Data Delete Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/vendor'));
    }

    public function userType($type) {
        if ($type == 'A') {
            return 'Superadmin';
        } else if ($type == 'F') {
            return 'Franchise';
        } else if ($type == 'V') {
            return 'Vendor';
        } else if ($type == 'S') {
            return 'Sub Vendor';
        } else if ($type == 'D') {
            return 'Distributor';
        } else if ($type == 'R') {
            return 'Subscriber';
        }
    }

    public function generatePassword() {
        $bytes = random_bytes(5);
        return bin2hex($bytes);
    }
}
