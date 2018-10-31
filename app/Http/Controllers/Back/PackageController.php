<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Package;

class PackageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $list = Package::orderBy('package_name', 'asc')->paginate(20);
        $count = Package::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('package');

        return view('back.package.index', compact('list', 'count', 'pageno', 'action', 'route'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['package_activeprice'] = 0;
        $data['package_autoactive'] = 1;

        $insert = Package::create($data);
        $pid = $insert->package_id;
        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/packagedetail/'.$pid));
    }

    public function edit($id) {
        $list = Package::orderBy('package_order', 'asc')->paginate(20);
        $count = Package::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Edit';
        $route = url('/package/' . $id);
        $detail = Package::find($id);

        return view('back.package.index', compact('list', 'count', 'pageno', 'action', 'route', 'detail'));
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $data['package_activeprice'] = 0;
        $data['package_autoactive'] = 1;

        $row = Package::find($id);
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
        return redirect(url('/package'));
    }

    public function destroy($id, Request $request) {
        $delete = Package::where('package_id', $id)->delete();

        if ($delete) {
            $message = 'Data Deleted Success.';
            $stat = 1;
        } else {
            $message = 'Data Delete Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/package'));
    }
}
