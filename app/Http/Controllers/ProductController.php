<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $slider;

    public function __construct(ProductService $productService, SliderService $slider)
    {
        $this->productService = $productService;
        $this->slider = $slider;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'sliders' => $this->slider->show(),
            'products' => $productsMore
        ]);
    }

    public function search(Request $request)
    {
        $query = Product::where('active', 1);
        
        // Chỉ tìm kiếm theo tên sản phẩm (name)
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'LIKE', "%{$keyword}%"); // Chỉ tìm trong trường name
        }

        // Tìm kiếm theo khoảng giá
        if ($request->input('price_range')) {
            $price_range = explode('-', $request->input('price_range'));
            if (count($price_range) == 2) {
                if ($price_range[1] != 'up') {
                    $query->whereBetween('price', [$price_range[0], $price_range[1]]);
                } else {
                    $query->where('price', '>=', $price_range[0]);
                }
            }
        }

        $products = $query->orderBy('id', 'desc')
                         ->paginate(12)
                         ->withQueryString();

        return view('search', [
            'title' => 'Kết quả tìm kiếm',
            'products' => $products,
            'keyword' => $request->input('keyword'),
            'priceRange' => $request->input('price_range'),
            'sliders' => $this->slider->show()
        ]);
    }
}
