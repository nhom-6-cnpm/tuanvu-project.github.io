<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $priceRange = $request->input('price_range');
            $sortBy = $request->input('sort_by', 'default');

            // Query cơ bản
            $query = Product::where('active', 1);

            // Tìm kiếm theo từ khóa
            if (!empty($keyword)) {
                $query->where(function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%")
                      ->orWhere('content', 'like', "%{$keyword}%");
                });
            }

            // Lọc theo khoảng giá
            if (!empty($priceRange)) {
                switch ($priceRange) {
                    case '0-100000':
                        $query->whereBetween('price', [0, 100000]);
                        break;
                    case '100000-500000':
                        $query->whereBetween('price', [100000, 500000]);
                        break;
                    // Thêm các khoảng giá khác nếu cần
                }
            }

            // Sắp xếp sản phẩm
            switch ($sortBy) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderByDesc('id');
                    break;
            }

            // Thực hiện truy vấn và phân trang
            $products = $query->paginate(12)->withQueryString();

            // Lấy slider
            $sliders = Slider::where('active', 1)->orderByDesc('sort_by')->get();

            return view('search', [
                'title' => 'Kết quả tìm kiếm' . (!empty($keyword) ? ': ' . $keyword : ''),
                'products' => $products,
                'keyword' => $keyword,
                'sliders' => $sliders,
                'priceRange' => $priceRange,
                'sortBy' => $sortBy
            ]);

        } catch (\Exception $e) {
            // Log lỗi
            \Log::error('Search Error: ' . $e->getMessage());
            
            return view('search', [
                'title' => 'Tìm kiếm sản phẩm',
                'products' => collect([]), // Trả về collection rỗng
                'keyword' => $request->input('keyword'),
                'sliders' => Slider::where('active', 1)->orderByDesc('sort_by')->get(),
                'error' => 'Đã có lỗi xảy ra trong quá trình tìm kiếm. Vui lòng thử lại.'
            ]);
        }
    }
} 