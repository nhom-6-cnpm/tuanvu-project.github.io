@extends('main')
@section('content')
    <section class="section-slide">
        <div class="wrap-slick1" style="height: 85px; overflow: hidden;">
            <div class="slick1">
                @foreach ($sliders as $slider)
                <div class="item-slick1" style="background-image: url( {{ $slider->thumb }} );">
                    <div class="container h-full">
                        <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-202 txt-center cl0 respon2">
                                    Camping
                                </span>
                            </div>
                                
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-104 ltext-102 txt-center cl0 p-t-22 p-b-40 respon1">
                                    {{ $slider->name }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container p-t-50 p-b-50">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg0 p-t-30 p-b-35 p-lr-35 m-lr-0-xl p-lr-15-sm">
                    <h3 class="text-center mb-4">Đăng Ký Tài Khoản</h3>
                    @include('admin.alert')
                    <form action="{{ route('user.register') }}" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Họ Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Xác nhận mật khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5">Đăng Ký</button>
                        </div>
                        <hr>
                        <p class="text-center">Đã có tài khoản? <a href="{{ route('user.login') }}">Đăng nhập</a></p>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 