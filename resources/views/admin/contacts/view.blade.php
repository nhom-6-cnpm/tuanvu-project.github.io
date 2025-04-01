@extends('admin.main')

@section('content')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên Khách Hàng:</label>
                        <p class="form-control-static">{{ $contact->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <p class="form-control-static">{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Số Điện Thoại:</label>
                        <p class="form-control-static">{{ $contact->phone }}</p>
                    </div>
                    <div class="form-group">
                        <label>Thời Gian Gửi:</label>
                        <p class="form-control-static">{{ $contact->created_at->format('H:i d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Nội Dung:</label>
                <div class="p-3 bg-light">
                    {!! nl2br(e($contact->content)) !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/admin/contacts/list" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
@endsection

@section('footer')

@endsection 