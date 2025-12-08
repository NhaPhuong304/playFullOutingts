<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ============================ CHI TIẾT SẢN PHẨM ============================
    public function detail($id)
    {
        $product = Product::findOrFail($id);

        /**
         * Vì KHÔNG còn category → ta chuyển sang related products theo logic khác:
         * - Gợi ý các sản phẩm ngẫu nhiên hoặc cùng giá gần giống
         * - Ở đây: lấy 8 sản phẩm bất kỳ trừ chính nó
         */
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('is_delete', 0)
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('user.detail', compact('product', 'relatedProducts'));
    }

    // ============================ TRANG SHOP (DANH SÁCH SẢN PHẨM) ============================
    public function shop(Request $request)
    {
        $query = Product::where('is_delete', 0)
            ->where('stock', '>', 0);

        // ----------- Tìm kiếm theo tên -----------
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }


        // ----------- Lọc theo giá -----------
        if ($request->filled('price')) {

            // Nếu chỉ có "all" → bỏ lọc
            if (in_array('all', $request->price) && count($request->price) == 1) {
                // không áp dụng filter
            } else {
                $query->where(function ($q) use ($request) {

                    foreach ($request->price as $priceRange) {

                        if ($priceRange === 'all') continue;

                        [$min, $max] = explode('-', $priceRange);

                        $q->orWhereBetween('price', [(float)$min, (float)$max]);
                    }
                });
            }
        }



        // ----------- Sắp xếp theo giá -----------
        if ($request->sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        // Phân trang
        $products = $query->paginate(6)->withQueryString();

        return view('user.shop', compact('products'));
    }
}
