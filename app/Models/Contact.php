<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
        'status'  // 0: Chưa xem, 1: Đã xem
    ];

    /**
     * Lấy trạng thái dạng text
     */
    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Đã xem' : 'Chưa xem';
    }
} 