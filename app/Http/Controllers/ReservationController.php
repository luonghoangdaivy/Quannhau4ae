<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\OrderDetail;

class ReservationController extends Controller
{
    /* ================= CREATE ==================== */
    public function create(Request $request)
    {
        // Lấy cart từ session
        $cart = session('cart', []);

        if (empty($cart)) {
            $items = collect();
            $total = 0;
            return view('reservations.create', compact('items','total'));
        }

        // Lấy product từ DB
        $ids = collect($cart)
            ->pluck('id')
            ->unique()
            ->map(fn($v) => (int)$v)
            ->values()
            ->all();

        $products = Product::whereIn('id', $ids)
            ->get()
            ->keyBy(fn($p) => (string)$p->id);

        // Build items
        $items = collect($cart)->map(function ($it) use ($products) {
            $id = (string)($it['id'] ?? $it['product_id'] ?? '');
            $p  = $products->get($id);

            $price = isset($it['price']) ? floatval($it['price']) : ($p?->price ?? 0);
            $qty   = intval($it['quantity'] ?? 1);

            return (object)[
                'product'    => $p,
                'product_id' => $id,
                'name'       => $it['name'] ?? ($p?->name ?? 'Sản phẩm'),
                'image'      => $it['image'] ?? ($p?->image ?? null),
                'qty'        => $qty,
                'price'      => $price,
                'subtotal'   => $price * $qty,
            ];
        })->values();

        $total = $items->sum('subtotal');

        return view('reservations.create', compact('items','total'));
    }

    /* ================= STORE ==================== */
    public function store(Request $request)
    {
        $request->validate([
            'table_id'     => 'required|integer|min:1',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'people'       => 'required|integer|min:1'
        ]);

        // Tạo reservation_time
        $reservation_time = $request->booking_date . ' ' . $request->booking_time . ':00';

        // Lấy giỏ hàng
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống.');
        }

        /* 1️⃣ Lưu đặt bàn */
        $reservation = Reservation::create([
            'user_id'          => auth()->id(),
            'table_id'         => $request->table_id,
            'reservation_time' => $reservation_time,
            'people'           => $request->people,
            'status'           => 'CONFIRMED'
        ]);

        /* 2️⃣ Tạo order */
        $order = Order::create([
            'user_id'  => auth()->id(),
            'table_id' => $request->table_id,
            'status'   => 'OPEN',
            'total'    => 0
        ]);

        $total = 0;

        /* 3️⃣ Lưu order detail (BẾP NHẬN Ở ĐÂY) */
        foreach ($cart as $c) {
            $product = Product::find($c['id']);
            if (!$product) continue;

            $qty   = (int)($c['quantity'] ?? 1);
            $price = $product->price;

            OrderDetail::create([
                'order_id'       => $order->id,
                'product_id'     => $product->id,
                'quantity'       => $qty,
                'price'          => $price,
                'kitchen_status' => 'PENDING' // 🔥 trạng thái cho nhân viên bếp
            ]);

            $total += $qty * $price;
        }

        /* 4️⃣ Update tổng tiền */
        $order->update(['total' => $total]);

        /* 5️⃣ Xóa giỏ hàng */
        session()->forget('cart');

        return redirect()
            ->route('reservation.success')
            ->with('success', 'Đặt bàn thành công!');
    }

    /* ================= ADMIN LIST ==================== */
    public function index()
    {
        $reservations = Reservation::with([
            'user',
            'order.orderDetails.product',
            'table'
        ])
        ->orderBy('reservation_time', 'desc')
        ->get();

        return view('admin.reservations.index', compact('reservations'));
    }
}
