@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Id</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Ưu Đãi</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 90px;">&nbsp;</th>

            </tr>
        </thead>
        <tbody>
            @foreach($products as $key  => $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->menu->name }}</td>
                <td>{{ number_format($product->price) }}</td>
                <td>{{ number_format($product->price_sale) }}</td>
                <td>{!! App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/ {{ $product->id }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="" 
                        onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {!! code !!} thực thi HTML --}}
    {!! $products->links('pagination::bootstrap-4') !!}
@endsection
