<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Camping\CampingRequest;
use App\Http\Services\Camping\CampingService;
use App\Models\Camping;
use Illuminate\Http\Request;

class CampingController extends Controller
{
    protected $campingService;

    public function __construct(CampingService $campingService)
    {
        $this->campingService = $campingService;
    }

    public function index()
    {
        return view('admin.camping.list', [
            'title' => 'Danh Sách Camping',
            'campings' => $this->campingService->get()
        ]);
    }

    public function create(){

        return view('admin.camping.add', [
            'title' => 'Thêm Camping',
            'menus' => $this->campingService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampingRequest $request)
    {
        $this->campingService->insert($request);

        return redirect()->back();
    }

    /**
     * (Product $product) kiểm tra có tồn tại trong data 
     */
    public function show(Camping $camping)
    {
        return view('admin.camping.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm',
            'menus' => $this->campingService->getMenu(),
            'camping' => $camping
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camping $camping)
    {
        $result = $this->campingService->update($request, $camping);
        if($result){
            return redirect('admin/campings/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->campingService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json(['error' => true,]);
    }
}
