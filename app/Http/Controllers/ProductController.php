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
    public function __construct()
    {
        $this->middleware('role:admin')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return response()->json(Product::with(['categories', 'publisher'])->get());
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->input('category_ids'));
        }
        return response()->json($product->load(['categories', 'publisher']), 201);
    }

    public function show($id)
    {
        return response()->json(Product::with(['categories', 'publisher'])->findOrFail($id));
    }

    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->input('category_ids'));
        }
        return response()->json($product->load(['categories', 'publisher']));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
