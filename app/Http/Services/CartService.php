<?php


namespace App\Http\Services;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $time = (int)$request->input('time');
        $product_id = (int)$request->input('product_id');
        
        if ($qty <= 0 || $time <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc thời gian không hợp lệ');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => [
                    'quantity' => $qty,
                    'time' => $time
                ]
            ]);
            return true;
        }

        $exists = isset($carts[$product_id]);

        if ($exists) {
            $carts[$product_id]['quantity'] = $qty;
            $carts[$product_id]['time'] = $time;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = [
            'quantity' => $qty,
            'time' => $time
        ];
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        try {
            $carts = Session::get('carts', []); // Lấy giỏ hàng hiện tại
            
            foreach ($carts as $productId => $item) {
                // Lấy số lượng mới từ request, nếu không có giữ nguyên số lượng cũ
                $quantity = $request->input('num_product.' . $productId);
                $time = $request->input('time.' . $productId);
                
                if ($quantity !== null && $time !== null) {
                    $carts[$productId] = [
                        'quantity' => (int)$quantity,
                        'time' => (int)$time
                    ];
                }
            }

            Session::put('carts', $carts);
            Session::flash('success', 'Cập nhật giỏ hàng thành công');
            return true;

        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật giỏ hàng lỗi, vui lòng thử lại');
            return false;
        }
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function order($request)
    {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');
            if (is_null($carts)) {
                return false;
            }

            // Tạo customer mới
            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            // Lưu thông tin đơn hàng
            $this->infoProductCart($carts, $customer->id);

            DB::commit();
            return true;

        } catch (\Exception $err) {
            DB::rollBack();
            return false;
        }
    }

    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id]['quantity'],
                'time' => $carts[$product->id]['time'],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
        }

        return Cart::insert($data);
    }

    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }

     
}