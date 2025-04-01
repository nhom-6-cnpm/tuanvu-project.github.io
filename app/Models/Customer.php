<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    //Loại Bỏ Các Thuộc tính dư thừa do người dùng nhập
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'content'
    ];

    public function carts()//liên kết CSDL
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
}
