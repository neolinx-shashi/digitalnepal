<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Channel;

class ChannelController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $list = Channel::orderBy('channel_name', 'asc')->paginate(20);
        $count = Channel::count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;

        return view('back.channel.index', compact('list', 'count', 'pageno'));
    }

    public function create() {
        $action = 'Add';
        $route = url('/channel');
        return view('back.channel.create', compact('action', 'route'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $insert = Channel::create($data);

        if ($insert) {
            $message = "Data Save Success.";
            $stat = 1;
        } else {
            $message = "Data Save Failed.";
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/channel'));
    }

    public function edit($id) {
        $action = 'Edit';
        $route = url('/channel/' . $id);
        $detail = Channel::find($id);

        return view('back.channel.create', compact('action', 'route', 'detail'));
    }

    public function update($id, Request $request) {
        $data = $request->all();
        $row = Channel::find($id);
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
        return redirect(url('/channel'));
    }

    public function destroy($id, Request $request) {
        $delete = Channel::where('channel_id', $id)->delete();

        if ($delete) {
            $message = 'Data Deleted Success.';
            $stat = 1;
        } else {
            $message = 'Data Delete Failed.';
            $stat = 0;
        }

        $request->session()->flash('status', $message);
        $request->session()->flash('stat', $stat);
        return redirect(url('/channel'));
    }
}
