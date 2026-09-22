<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Thêm model Category
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', 1);
        
        // Lọc theo danh mục
        $categoryId = $request->get('category');
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        $products = $query->orderBy('id', 'desc')->paginate(12);
        
        // Lấy tất cả danh mục
        $categories = Category::all();
        
        // Lấy danh mục đang được chọn (nếu có)
        $selectedCategory = null;
        if ($categoryId) {
            $selectedCategory = Category::find($categoryId);
        }
        
        return view('menu.index', compact('products', 'categories', 'selectedCategory'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->input('q', ''));
        $categoryId = $request->get('category');

        // Nếu rỗng -> show index (giữ behavior bạn muốn)
        if ($q === '' && !$categoryId) {
            return redirect()->route('menu.index');
        }

        $query = Product::where('is_active', 1);
        
        // Lọc theo danh mục (nếu có)
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        // Tìm kiếm theo từ khóa
        if ($q !== '') {
            $query->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            });
        }
        
        $products = $query->orderBy('id', 'desc')->paginate(12);
        
        // Lấy tất cả danh mục
        $categories = Category::all();
        
        // Lấy danh mục đang được chọn (nếu có)
        $selectedCategory = null;
        if ($categoryId) {
            $selectedCategory = Category::find($categoryId);
        }
        
        // Giữ param trên phân trang
        $products->appends(['q' => $q, 'category' => $categoryId]);

        // Nếu là AJAX (live search) -> trả partial HTML để JS render
        if ($request->ajax()) {
            $html = View::make('menu._list', compact('products'))->render();
            return response()->json([
                'ok' => true,
                'html' => $html,
                'count' => $products->total()
            ]);
        }

        return view('menu.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'q' => $q,
        ]);
    }

    // (tùy chọn) helper kiểm tra fulltext index - để dùng sau nếu muốn
protected function dbHasFullText(): bool
    {
        try {
            $driver = DB::getDriverName();
            if ($driver !== 'mysql') return false;
            $row = DB::selectOne("
                SELECT COUNT(1) AS c
                FROM information_schema.STATISTICS
                WHERE TABLE_SCHEMA = DATABASE()
                  AND TABLE_NAME = 'products'
                  AND INDEX_TYPE = 'FULLTEXT'
            ");
            return ($row && ($row->c ?? 0) > 0);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function show($id)
    {
        $product = Product::where('is_active', 1)->find($id);
        
        if (!$product) {
            abort(404, 'Sản phẩm không tồn tại hoặc đã ngừng bán');
        }
        
        // Lấy các sản phẩm cùng danh mục (gợi ý)
        $relatedProducts = Product::where('is_active', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        
        return view('menu.show', compact('product', 'relatedProducts'));
    }
}
