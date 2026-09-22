<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductAdminController extends Controller
{
    public function index() {
        $products = Product::with('category')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('product','public');
        }

        Product::create($data);
        return redirect()->route('product.index')->with('success','Thêm món thành công!');
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();

    return view('admin.product.edit', compact('product', 'categories'));
}


    public function update(Request $request, $id)
{
    $data = $request->validate([
        'category_id' => 'required',
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        $data['image'] = $request->image->store('product', 'public');
    }

    $product->update($data);

    return redirect()->route('product.index')->with('success','Cập nhật thành công!');
}


    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('product.index')
        ->with('success', 'Xóa món thành công!');
}

}

