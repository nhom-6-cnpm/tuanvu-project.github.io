<?php

namespace App\Http\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;


class MenuComposer{

    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        //truyền data ra view
        $menus = Menu::select('id', 'name', 'parent_id')->where('active', 1)->orderByDesc('id')->get();

        //Dùng biến menus để nhận dữ liệu truyền vào
        $view->with('menus', $menus);
    }
}