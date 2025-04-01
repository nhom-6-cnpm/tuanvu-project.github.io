<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camping extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'menu_id',
        'address',
        'description',
        'thumb',
        'price',
        'active'
    ];

    public function menu(){

        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
        // 1 camping chỉ có 1 danh mục
    }
}
