<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];

    public function menu(){

        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
        // 1 sản phẩm chỉ có 1 danh mục và 1 danh mục có nhiều sản phẩm
    }
}
