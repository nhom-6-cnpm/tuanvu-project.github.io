@extends('admin.main')

@section('content')

            <div class="card-body">
                <div class="btn-group mb-3">
                    <a href="/admin/contacts/list" 
                       class="btn {{ !request()->has('status') ? 'btn-primary' : 'btn-default' }}">
                        Tất cả
                    </a>
                    <a href="/admin/contacts/list?status=0" 
                       class="btn {{ request('status') === '0' ? 'btn-warning' : 'btn-default' }}">
                        Chưa xem
                    </a>
                    <a href="/admin/contacts/list?status=1" 
                       class="btn {{ request('status') === '1' ? 'btn-success' : 'btn-default' }}">
                        Đã xem
                    </a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Khách Hàng</th>
                            <th>Số Điện Thoại</th>
                            <th>Email</th>
                            <th>Nội Dung</th>
                            <th>Ngày Gửi</th>
                            <th>Trạng Thái</th>
                            <th style="width: 100px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($contacts->count() > 0)
                            @foreach($contacts as $key => $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ Str::limit($contact->content, 50) }}</td>
                                    <td>{{ date('H:i d/m/Y', strtotime($contact->created_at)) }}</td>
                                    <td>
                                        @if($contact->status == 0)
                                            <span class="btn btn-warning btn-xs">Chưa xem</span>
                                        @else
                                            <span class="btn btn-success btn-xs">Đã xem</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" 
                                           href="/admin/contacts/view/{{ $contact->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" 
                                           onclick="removeRow({{ $contact->id }}, '/admin/contacts/destroy')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $contacts->links() }}

@endsection

@section('footer')

@endsection
