<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Validation\ValidationException;//thêm

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort', 'asc');

        $products = Product::orderBy('id', $sortOrder)->paginate(3);

        $products->getCollection()->transform(function ($product) {
            $now = Carbon::now();

            // Kiểm tra nếu ngày hiện tại nằm trong khoảng giảm giá
            $isDiscountActive = $product->special_price_start && $product->special_price_end &&
                                $now->between($product->special_price_start, $product->special_price_end);

            // Định dạng giá
            if ($isDiscountActive && $product->selling_price && $product->selling_price != $product->price) {
                $product->formatted_price = "<span class='text-danger fw-bold'>" . number_format($product->selling_price, 2) . " VNĐ</span> " .
                                            "<del class='text-muted ms-2'>" . number_format($product->price, 2) . " VNĐ</del>";
            } else {
                $product->formatted_price = "<span class='fw-bold'>" . number_format($product->price, 2) . " VNĐ</span>";
            }

            // Tính thời gian cập nhật
            $days_diff = $now->diffInDays($product->updated_at);
            $product->formatted_updated_at = ($days_diff < 30) ?
                "<span class='text-success'>{$days_diff} ngày trước</span>" :
                "<span class='text-primary'>" . floor($days_diff / 30) . " tháng trước</span>";

            return $product;
        });

        return view('products.index', compact('products', 'sortOrder'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request) {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'brand_id' => 'required|integer',
            'tax_class_id' => 'nullable|integer',
            'is_active' => 'boolean',
            'slug' => 'required|unique:products,slug',
            'meta' => 'nullable|array',
            'attributes' => 'nullable|array',
            'downloads' => 'nullable|array',
            'variations' => 'nullable|array',
            'variants' => 'nullable|array',
            'options' => 'nullable|array',
        ]);

        // Lưu sản phẩm vào database
        $product = Product::create($validatedData);

        return response()->json([
            'message' => 'Sản phẩm đã được thêm thành công!',
            'product' => $product
        ], 201);
    }//sửa

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
