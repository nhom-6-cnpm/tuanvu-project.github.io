<?php


namespace App\Http\Services\Menu;


use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $menu): bool
    {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }


    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        // Xử lý tìm kiếm
        if ($request->input('search-product')) {
            $searchTerm = $request->input('search-product');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        // Kiểm tra xem người dùng có chọn cách sắp xếp theo giá không
        if ($request->input('price')) {
            $priceRange = $request->input('price');

            // Sắp xếp theo giá giảm (nếu có) hoặc giá thường
            if ($priceRange == 'asc') {
                $query->orderByRaw('CASE WHEN price_sale > 0 THEN price_sale ELSE price END ASC');
            } elseif ($priceRange == 'desc') {
                $query->orderByRaw('CASE WHEN price_sale > 0 THEN price_sale ELSE price END DESC');
            } elseif (strpos($priceRange, '-') !== false) {
                // Nếu là khoảng giá, tách min và max
                list($min, $max) = explode('-', $priceRange);

                // Lọc theo khoảng giá, ưu tiên price_sale nếu có
                $query->where(function ($q) use ($min, $max) {
                    $q->whereBetween('price_sale', [(float)$min, (float)$max])
                    ->orWhereBetween('price', [(float)$min, (float)$max]);
                });
            }
        }

        // Sắp xếp theo ID giảm dần
        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}