<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Commission;

class CommissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $userId = Auth::user()->id;
        $list = Commission::leftJoin('users', 'commission.commission_from', '=', 'users.id')
                    ->select('commission.*', 'users.name')
                    ->where('commission.user_id', $userId)
                    ->paginate(20);
        $total = Commission::where('user_id', $userId)->sum('commission_amount');
        $count = Commission::where('user_id', $userId)->count();
        $pageno = (isset($_GET['page'])) ? 20 * ($_GET['page'] - 1) : 0;

        return view('back.commission.index', compact('list', 'count', 'pageno', 'total'));
    }
}
