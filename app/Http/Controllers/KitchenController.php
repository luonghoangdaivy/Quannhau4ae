<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;

class KitchenController extends Controller
{
    /**
     * Trang nhân viên bếp
     * Hiển thị các món cần làm
     */
    public function index()
    {
        $items = OrderDetail::with(['product', 'order'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('kitchen.index', compact('items'));
    }

    /**
     * Cập nhật trạng thái món ăn
     * PENDING | COOKING | DONE
     */
    public function updateStatus(Request $request, $id)
    {
        $item = OrderDetail::findOrFail($id);

        $item->update([
            'kitchen_status' => $request->status
        ]);

        return back()->with('success', 'Cập nhật trạng thái món thành công');
    }
}
