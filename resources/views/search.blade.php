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

    <div class="container p-t-80">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Tìm kiếm
            </span>
        </div>

        <div class="p-t-20">
            <form action="{{ route('search') }}" method="GET" class="search-form">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="search-label">Tên sản phẩm</label>
                            <input type="text" name="keyword" class="form-control search-input" 
                                placeholder="Nhập tên sản phẩm..." 
                                value="{{ request('keyword') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="search-label">Khoảng giá</label>
                            <select name="price_range" class="form-control search-select">
                                <option value="">Tất cả mức giá</option>
                                <option value="0-100000" {{ request('price_range') == '0-100000' ? 'selected' : '' }}>
                                    Dưới 100,000đ
                                </option>
                                <option value="100000-300000" {{ request('price_range') == '100000-300000' ? 'selected' : '' }}>
                                    100,000đ - 300,000đ
                                </option>
                                <option value="300000-500000" {{ request('price_range') == '300000-500000' ? 'selected' : '' }}>
                                    300,000đ - 500,000đ
                                </option>
                                <option value="500000-1000000" {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>
                                    500,000đ - 1,000,000đ
                                </option>
                                <option value="1000000-up" {{ request('price_range') == '1000000-up' ? 'selected' : '' }}>
                                    Trên 1,000,000đ
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom">
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg0 m-t-23 p-b-140">
            <div class="container">
                <h3 class="p-b-20">
                    @if($products->count() > 0)
                        Kết quả tìm kiếm {{ !empty($keyword) ? 'cho "' . $keyword . '"' : '' }}
                        ({{ $products->total() }} sản phẩm)
                    @else
                        Không tìm thấy sản phẩm nào phù hợp.
                    @endif
                </h3>

                @if($products->count() > 0)
                    <div class="row isotope-grid">
                        @foreach($products as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{ $product->thumb }}" alt="{{ $product->name }}">
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l">
                                            <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"
                                               class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $product->name }}
                                            </a>

                                            <span class="stext-105 cl3">
                                                {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    {!! $products->appends(request()->all())->links() !!}
                @endif
            </div>
        </div>
    </div>

    <style>
        .search-form {
            padding: 20px 0;
        }

        .search-label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .search-input {
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            width: 100%;
            background-color: #fff;
        }

        .search-input:focus {
            border-color: #666;
            outline: none;
            box-shadow: none;
        }

        .search-input::placeholder {
            color: #999;
            font-size: 14px;
            font-style: italic;
        }

        .search-select {
            height: 40px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            background-color: #fff;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
        }

        .search-select:focus {
            border-color: #666;
            outline: none;
            box-shadow: none;
        }

        .btn-search-custom {
            height: 40px;
            width: 100%;
            background-color: #333;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-search-custom:hover {
            background-color: #000;
        }

        @media (max-width: 768px) {
            .search-form {
                padding: 15px 0;
            }

            .col-md-3, .col-md-4, .col-md-2 {
                margin-bottom: 15px;
            }

            .col-md-2 {
                padding-top: 24px;
            }
        }
    </style>
@endsection 