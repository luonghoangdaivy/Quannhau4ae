<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Helper: get cart from session (associative array product_id => item)
    protected function getCart(): array
    {
        return session('cart', []); // array of items
    }

    // Helper: save cart back to session
    protected function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
        session()->save();
    }

    // returns cart total count (sum quantities)
    protected function cartCount(): int
    {
        $cart = $this->getCart();
        $count = 0;
        foreach ($cart as $item) {
            $count += intval($item['quantity'] ?? 0);
        }
        return $count;
    }

    // compute total price
    protected function cartTotal(array $cart): float
    {
        $total = 0.0;
        foreach ($cart as $it) {
            $total += floatval($it['price'] ?? 0) * intval($it['quantity'] ?? 0);
        }
        // round to 2 decimals to avoid float issues
        return round($total, 2);
    }

    /**
     * Ajax add product to cart
     * Accepts either (id, quantity) and will try to read product info from DB (if Product model exists),
     * or accepts (id, name, price, image) from client when DB lookup is not available.
     */
    public function add(Request $request)
    {
        // Accept id as integer; if you have products table, consider using exists:products,id
        $request->validate([
            'id' => 'required|integer',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|string'
        ]);

        $id = (string) intval($request->input('id'));
        $qty = intval($request->input('quantity', 1));

        // Try to load product from DB if model exists
        $name = $request->input('name', 'Sản phẩm');
        $price = floatval($request->input('price', 0));
        $image = $request->input('image', null);

        if (class_exists(\App\Models\Product::class)) {
            try {
                $product = \App\Models\Product::find(intval($id));
                if ($product) {
                    $name = $product->name ?? $name;
                    $price = isset($product->price) ? floatval($product->price) : $price;
                    // try common image fields
                    if (isset($product->image) && $product->image) {
                        $image = $product->image;
                    } elseif (isset($product->thumbnail) && $product->thumbnail) {
                        $image = $product->thumbnail;
                    }
                } else {
                    // if product id not found, return error (safer)
                    return response()->json(['ok' => false, 'message' => 'Sản phẩm không tồn tại'], 404);
                }
            } catch (\Throwable $e) {
                // ignore DB lookup errors, continue with client-provided fields
            }
        }

        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = intval($cart[$id]['quantity'] ?? 0) + $qty;
            // keep product info up-to-date
            $cart[$id]['name'] = $name;
            $cart[$id]['price'] = $price;
            if ($image) $cart[$id]['image'] = $image;
        } else {
            // create item
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $qty,
                'image' => $image,
            ];
        }

        $this->saveCart($cart);

        return response()->json([
            'ok' => true,
            'message' => 'Đã thêm vào giỏ',
            'count' => $this->cartCount(),
            'dropdownHtml' => view('cart.preview_dropdown', ['cart' => $cart])->render(),
        ]);
    }

    // Return dropdown HTML (so client can refresh it)
    public function dropdown()
    {
        $cart = $this->getCart();
        return view('cart.preview_dropdown', ['cart' => $cart]);
    }

    // Cart page (review / adjust before checkout)
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', ['cart' => $cart]);
    }

    // update quantity (AJAX or normal POST)
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $id = (string) intval($request->input('id'));
        $qty = intval($request->input('quantity'));
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            $this->saveCart($cart);
        } else {
            // if item doesn't exist, return error for clarity
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['ok' => false, 'message' => 'Sản phẩm không có trong giỏ'], 404);
            }
            return back()->with('error', 'Sản phẩm không có trong giỏ');
        }

        $subtotal = round(floatval($cart[$id]['price']) * intval($cart[$id]['quantity']), 2);
        $total = $this->cartTotal($cart);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'ok' => true,
                'count' => $this->cartCount(),
                'subtotal' => $subtotal,
                'total' => $total,
                'dropdownHtml' => view('cart.preview_dropdown', ['cart' => $cart])->render()
            ]);
        }

        return back()->with('success', 'Cập nhật giỏ hàng');
    }

    // remove item
    public function remove(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $id = (string) intval($request->input('id'));
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        } else {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['ok' => false, 'message' => 'Sản phẩm không có trong giỏ'], 404);
            }
            return back()->with('error', 'Sản phẩm không có trong giỏ');
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'ok' => true,
                'count' => $this->cartCount(),
                'total' => $this->cartTotal($cart),
                'dropdownHtml' => view('cart.preview_dropdown', ['cart' => $cart])->render()
            ]);
        }

        return back()->with('success', 'Đã xóa món khỏi giỏ');
    }

    // checkout: here we just simulate order saving or you can integrate DB logic
    public function checkout(Request $request)
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống.');
        }

        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:500',
            'note' => 'nullable|string|max:1000',
        ]);

        // calculate total
        $total = $this->cartTotal($cart);

        // TODO: replace this demo logic with DB saving (Order + OrderDetail) if team wants
        $orderId = strtoupper(uniqid('ORD-'));

        // store order data in log for demo / debugging
        \Log::info('New order (demo): '.$orderId, [
            'customer' => $data,
            'cart' => $cart,
            'total' => $total,
        ]);

        // clear cart after successful checkout
        session()->forget('cart');

        // redirect to menu with success message (you can change to confirmation view)
        return redirect()->route('menu.index')->with('success', 'Thanh toán thành công. Mã đơn: '.$orderId);
    }
}
