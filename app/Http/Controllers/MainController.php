<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{
    protected $slider;
    protected $product;

    public function __construct(SliderService $slider, ProductService $product)
    {
        $this->slider = $slider;
        $this->product = $product;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Camping Shop',
            'sliders' => $this->slider->show(),
            'products' => $this->product->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result])->render();
            
            return response()->json([
                'html' => $html,
                'lastPage' => count($result) < ProductService::LIMIT
            ]);
        }
        
        return response()->json(['html' => '']);
    }
}
