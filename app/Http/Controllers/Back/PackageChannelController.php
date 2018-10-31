<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PackageChannel;
use App\Model\Channel;
use App\Model\Package;

class PackageChannelController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($pid) {
        $package = Package::find($pid);
        $channel_list = Channel::orderBy('channel_name', 'asc')->get();
        $list = PackageChannel::leftJoin('channel', 'package_channel.channel_id', '=', 'channel.channel_id')
                ->where('package_channel.package_id', $pid)
                ->get();
        $rc = PackageChannel::where('package_id', $pid)->get();
        $count = PackageChannel::where('package_id', $pid)->count();

        return view('back.package.package_channel', compact('channel_list', 'list', 'count', 'package', 'pid', 'rc'));
    }

    public function store($pid, Request $request) {
        $data = $request->all();
        $channels = explode(',', rtrim($data['cid'], ','));
        $delete = PackageChannel::where('package_id', $pid)->delete();
        for ($i = 0; $i < count($channels); $i++) {
            $insert = PackageChannel::insert(['package_id' => $pid, 'channel_id' => $channels[$i]]);
        }
        return redirect('/package');
    }
}
