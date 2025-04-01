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
                                
                            {{-- <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{ $slider->url }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                                    
                @endforeach
                
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        @if (count($products) != 0)
            <div class="row">
                <!-- Phần bảng sản phẩm - Chiếm 75% -->
                <div class="col-lg-9">
                    <form method="post" action="/update-cart" id="form-update-cart">
                        @csrf
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <thead>
                                    <tr class="table_head">
                                        <th class="column-1">SẢN PHẨM</th>
                                        <th class="column-2">TÊN</th>
                                        <th class="column-3">GIÁ</th>
                                        <th class="column-4">SỐ LƯỢNG</th>
                                        <th class="column-5">THỜI GIAN</th>
                                        <th class="column-6">TỔNG</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; $priceEnd = 0; @endphp
                                    @foreach($products as $key => $product)
                                        @php
                                            // Lấy giá sản phẩm
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;

                                            // Kiểm tra xem sản phẩm có trong giỏ hàng không
                                            if (isset($carts[$product->id])) {
                                                // Lấy quantity và time từ giỏ hàng
                                                $quantity = $carts[$product->id]['quantity'];
                                                $time = $carts[$product->id]['time'];
                                        
                                                // Tính toán giá kết thúc
                                                $priceEnd = $price * $quantity * $time;
                                                $total += $priceEnd;
                                            }
                                        @endphp
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->thumb }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{ $product->name }}</td>
                                            <td class="column-3">{{ number_format($price) }}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" 
                                                        name="num_product[{{ $product->id }}]" 
                                                        value="{{ $carts[$product->id]['quantity'] }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" 
                                                        name="time[{{ $product->id }}]" 
                                                        value="{{ $carts[$product->id]['time'] }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-6">{{ number_format($priceEnd) }}</td>
                                            <td class="p-r-15">
                                                <a href="/carts/delete/{{ $product->id }}" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark">
                                CẬP NHẬT GIỎ HÀNG
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Phần tổng giỏ hàng - Chiếm 25% -->
                <div class="col-lg-3">
                    <form method="post" action="/carts" id="order-form">
                        @csrf
                        <div class="cart-summary">
                            <h5 class="summary-title">TỔNG GIỎ HÀNG</h5>
                            
                            <div class="summary-item">
                                <span>Tổng cộng:</span>
                                <span class="summary-price">{{ number_format($total, 0, '', '.') }}đ</span>
                            </div>

                            <div class="summary-info">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name') }}" placeholder="Tên khách hàng *" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                    value="{{ old('phone') }}" placeholder="Số điện thoại *" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                                    value="{{ old('address') }}" placeholder="Địa chỉ giao hàng *" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" placeholder="Email liên hệ *" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                <textarea name="content" class="form-control" 
                                    placeholder="Ghi chú">{{ old('content') }}</textarea>
                            </div>

                            <button type="submit" class="btn-order">
                                ĐẶT HÀNG
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center">
                <h2>Giỏ Hàng Trống</h2>
                <a href="/" class="btn btn-primary mt-3">Tiếp Tục Mua Hàng</a>
            </div>
        @endif
    </div>

    <style>
        .cart-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .summary-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .summary-price {
            font-weight: bold;
            color: #dc3545;
        }

        .summary-info .form-control {
            font-size: 13px;
            padding: 8px 12px;
            margin-bottom: 10px;
        }

        .btn-order {
            width: 100%;
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-order:hover {
            background: #000;
        }

        /* Style cho bảng sản phẩm */
        .table-shopping-cart th {
            font-size: 13px;
            padding: 12px;
            background: #f8f9fa;
        }

        .table-shopping-cart td {
            padding: 12px;
            vertical-align: middle;
        }

        .how-itemcart1 {
            width: 100px;
            height: 100px;
        }

        .how-itemcart1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        // Xử lý nút tăng
        $('.btn-num-product-up').on('click', function() {
            var input = $(this).siblings('.num-product');
            var currentValue = parseInt(input.val());
            input.val(currentValue + 1);
        });

        // Xử lý nút giảm
        $('.btn-num-product-down').on('click', function() {
            var input = $(this).siblings('.num-product');
            var currentValue = parseInt(input.val());
            if(currentValue > 1) {
                input.val(currentValue - 1);
            }
        });
    });
</script>
@endsection