<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;
use App\Http\Services\Slider\SliderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendMail;

class CartController extends Controller
{
    protected $cartService;
    protected $slider;

    public function __construct(CartService $cartService, SliderService $slider)
    {
        $this->cartService = $cartService;
        $this->slider = $slider;
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => true,
                'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng'
            ]);
        }

        try {
            $result = $this->cartService->create($request);
            if ($result === false) {
                return redirect()->back()->with('error', 'Thêm sản phẩm thất bại');
            }

            return redirect('/carts')->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng');
        }

        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts'),
            'sliders' => $this->slider->show()
        ]);
    }

    public function update(Request $request)
    {
        try {
            // Lấy dữ liệu từ giỏ hàng hiện tại
            $carts = Session::get('carts', []);

            // Cập nhật số lượng và thời gian cho từng sản phẩm
            foreach ($carts as $productId => $item) {
                if (isset($request->num_product[$productId])) {
                    $carts[$productId]['quantity'] = (int)$request->num_product[$productId];
                }
                if (isset($request->time[$productId])) {
                    $carts[$productId]['time'] = (int)$request->time[$productId];
                }
            }

            // Lưu lại vào session
            Session::put('carts', $carts);
            Session::flash('success', 'Cập nhật giỏ hàng thành công');

            return redirect()->back();

        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật giỏ hàng lỗi, vui lòng thử lại');
            return redirect()->back();
        }
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function order(Request $request)
    {
        try {
            // Validate dữ liệu
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required|email'
            ]);

            DB::beginTransaction();
            
            if ($this->cartService->order($request)) {
                // Chuẩn bị dữ liệu cho email
                $orderData = [
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email')
                ];

                // Xóa giỏ hàng sau khi đặt hàng thành công
                Session::forget('carts');
                
                // Gửi mail xác nhận đơn hàng
                SendMail::dispatch($orderData);
                
                DB::commit();
                return redirect('/carts')->with('success', 'Đặt hàng thành công. Vui lòng kiểm tra email của bạn.');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Đặt hàng không thành công. Vui lòng thử lại.');

        } catch (\Exception $err) {
            DB::rollBack();
            \Log::error($err->getMessage());
            return redirect()->back()->with('error', 'Lỗi đặt hàng: ' . $err->getMessage());
        }
    }
}