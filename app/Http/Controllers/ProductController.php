<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

/**
*AE lưu ý dùng các hàm trong ProductController để quản lý sản phẩm như sau:
*5 hàm -> index, store, show, update, destroy
*index: lấy danh sách sản phẩm
*store: lưu sản phẩm mới
*show: lấy thông tin sản phẩm theo id
*update: cập nhật thông tin sản phẩm theo id
*destroy: xóa sản phẩm theo id
*/

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }


    /**
     * Store lưu sản phẩm mới.
     * Viết 1 request riêng để validate dữ liệu đầu vào.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->safe()->only([
            'title',
            'author',
            'cover_image',
            'price',
            'description',
            'stock'
        ]);
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'cover_image' => $request->input('cover_image'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
        ]);
        return response()->json($product);

    }

    /**
     * Hàm xóa sản phẩm theo id.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
