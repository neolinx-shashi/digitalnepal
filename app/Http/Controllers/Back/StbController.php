<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Stb;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class StbController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $list = Stb::orderBy('stb_number', 'asc')->paginate(20);
        $count = Stb::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Add';
        $route = url('stb');

        return view('back.stb.index', compact('list', 'count', 'pageno', 'action', 'route'));
    }

    public function store(Request $request) {
        /*
        $data = $request->all();
        $data['stb_activeprice'] = 0;
        $data['stb_autoactive'] = 1;

        $insert = Stb::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }
        */
        $data = $request->all();
        $file = $request->file('stb_file'); //echo $file;die;
        $excel = Excel::import(new UsersImport, $file);
//var_dump($excel);die;
        //$request->session()->flash('status', $message);
        //$request->session()->flash('stat', $stat);
        return redirect(url('/stb'));
    }

    public function edit($id) {
        $list = Stb::orderBy('stb_order', 'asc')->paginate(20);
        $count = Stb::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;
        $action = 'Edit';
        $route = url('/stb/' . $id);
        $detail = Stb::find($id);

        return view('back.stb.index', compact('list', 'count', 'pageno', 'action', 'route', 'detail'));
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $data['stb_activeprice'] = 0;
        $data['stb_autoactive'] = 1;

        $row = Stb::find($id);
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
        return redirect(url('/stb'));
    }

    public function destroy($id, Request $request) {
        $delete = Stb::where('stb_id', $id)->delete();

        if ($delete) {
            $message = 'Data Deleted Success.';
            $stat = 1;
        } else {
            $message = 'Data Delete Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/stb'));
    }
}
