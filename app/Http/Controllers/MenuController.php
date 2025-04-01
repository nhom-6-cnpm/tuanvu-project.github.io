<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;

class MenuController extends Controller
{
    protected $menuService;
    protected $slider;

    public function __construct(MenuService $menuService, SliderService $slider)
    {
        $this->menuService = $menuService;
        $this->slider = $slider;

    }

    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getId($id);
        $products = $this->menuService->getProduct($menu, $request);

        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu'  => $menu,
            'sliders' => $this->slider->show()

        ]);
    }
}
