<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('product','public');
        }

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success','Thêm món thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('product','public');
        }

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success','Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success','Đã xoá món.');
    }
}
