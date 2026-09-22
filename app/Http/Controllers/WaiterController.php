<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;

class WaiterController extends Controller
{
    /**
     * Danh sách món đã làm xong (phục vụ nhận món)
     */
    public function index()
    {
        $items = OrderDetail::with(['product', 'order'])
            ->where('kitchen_status', 'DONE')
            ->orderBy('updated_at', 'asc')
            ->get();

        return view('waiter.index', compact('items'));
    }
}
