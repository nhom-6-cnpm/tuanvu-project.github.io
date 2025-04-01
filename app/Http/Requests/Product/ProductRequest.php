<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // giới hạn quyền truy cập nếu return false
    public function authorize(): bool 
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'thumb' => 'required'

        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'Vui lòng nhập tên Sản Phẩm',
            'thumb.required' => 'Vui lòng chọn ảnh cho Sản Phẩm'

        ];
    }
}
