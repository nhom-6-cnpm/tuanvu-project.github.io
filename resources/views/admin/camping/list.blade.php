@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Id</th>
                <th>Tên Camping</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Mô Tả</th>
                <th>Địa Chỉ</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 90px;">&nbsp;</th>

            </tr>
        </thead>
        <tbody>
            @foreach($campings as $key  => $camping)
            <tr>
                <td>{{ $camping->id }}</td>
                <td>{{ $camping->name }}</td>
                <td>{{ $camping->menu->name }}</td>
                <td>{{ number_format($camping->price) }}</td>
                <td>{{ $camping->description }}</td>
                <td>{{ $camping->address }}</td>
                <td>{!! App\Helpers\Helper::active($camping->active) !!}</td>
                <td>{{ $camping->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/campings/edit/ {{ $camping->id }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="" 
                        onclick="removeRow({{ $camping->id }}, '/admin/campings/destroy')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {!! code !!} thực thi HTML --}}
    {!! $campings->links('pagination::bootstrap-4') !!}
@endsection
