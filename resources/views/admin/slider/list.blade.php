@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tiêu Đề</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 90px;">&nbsp;</th>

            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key  => $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td>
                    <a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" height="40px">
                    </a>
                </td>
                <td>{!! App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/ {{ $slider->id }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="" 
                        onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {!! code !!} thực thi HTML --}}
    {!! $sliders->links('pagination::bootstrap-4') !!}
@endsection
