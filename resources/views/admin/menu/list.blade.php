@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Id</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 90px;">&nbsp;</th>

            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection
