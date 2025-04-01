<?php

namespace App\Http\Services\Camping;

use App\Models\Camping;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CampingService{

    public function getMenu(){

        return Menu::where('active', 1)->get();
    }

    public function isValiPrice($request){

        if($request->input('price') != 0 
            && $request->input('price') < 0)
        {
            Session::flash('error', 'Giá phải lớn hơn 0');
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
            Camping::create($request->all());

            Session::flash('success', 'Thêm camping thành công');
        }catch (\Exception $err) {
            Session::flash('error', 'Lỗi trong quá trình thực hiện: ' . $err->getMessage());
            Log::error($err);
            return false;
        }

        return true;
    }

    public function get(){

        return Camping::with('menu')->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product){

        // $isValiPrice = $this->isValiPrice($request);
        // if($isValiPrice == false){
        //     return false;
        // }

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

        $product = Camping::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }

        return false;
    }
}