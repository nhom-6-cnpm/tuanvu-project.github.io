<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ProductAdminService{

    public function getMenu(){

        return Menu::where('active', 1)->get();
    }

    public function isValiPrice($request){

        if($request->input('price') != 0 
            && $request->input('price_sale') != 0
            && $request->input('price') <= $request->input('price_sale'))
        {
            Session::flash('error', 'Giá ưu đãi phải nhỏ hơn giá ban đầu');
            return false;
        }

        if($request->input('price_sale') != 0 && (int)$request->input('price') == 0){

            Session::flash('error', 'Vui lòng nhập giá ban đầu');
            return false;
        }

        return true;
    }

    public function insert($request){

        $isValiPrice = $this->isValiPrice($request);
        if($isValiPrice == false){
            return false;
        }

        try {
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Thêm sản phẩm thành công');
        }catch (\Exception $err) {
            Session::flash('error', 'Lỗi trong quá trình thực hiện: ' . $err->getMessage());
            Log::error($err);
            return false;
        }

        return true;
    }

    public function get(){

        return Product::with('menu')->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product){

        $isValiPrice = $this->isValiPrice($request);
        if($isValiPrice == false){
            return false;
        }

        try {

            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');

        } catch (\Throwable $th) {
            Session::flash('error', 'Lỗi vui lòng thử lại');
            return  false;
        }

        return true;
    }

    public function delete($request){

        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }

        return false;
    }
}