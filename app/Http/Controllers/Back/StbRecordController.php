<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\StbRecord;
use App\Model\Vendor;
use App\Model\Stb;

class StbRecordController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $list = StbRecord::leftJoin('users', 'stb_record.user_id', '=', 'users.id')
                ->select('stb_record.*', 'users.name')
                ->orderBy('stb_record.start_date', 'desc')
                ->paginate(20);
        $count = StbRecord::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;

        return view('back.stbrecord.index', compact('list', 'count', 'pageno'));
    }

    public function create() {
        $action = 'Add';
        $users = Vendor::where('type', 'R')->where('parent', Auth::user()->id)->orderBy('name', 'asc')->get();
        $today = date("Y-m-d");
        $route = url('/stb-record');
        $stb = Stb::orderBy('stb_number', 'asc')->get();
        return view('back.stbrecord.create', compact('action', 'route', 'users', 'today', 'stb'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $insert = StbRecord::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/stb-record'));
    }

    public function edit($id) {
        $action = 'Edit';
        $route = url('/stb-record/' . $id);
        $users = Vendor::where('type', 'R')->where('parent', Auth::user()->id)->orderBy('name', 'asc')->get();
        $detail = StbRecord::find($id);

        return view('back.stbrecord.create', compact('action', 'route', 'detail', 'users'));
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $row = StbRecord::find($id);
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
        return redirect(url('/stb-record'));
    }

    public function destroy($id, Request $request) {
        $delete = StbRecord::where('stb_id', $id)->delete();

        if ($delete) {
            $message = 'Data Deleted Success.';
            $stat = 1;
        } else {
            $message = 'Data Delete Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/stb-record'));
    }
}
