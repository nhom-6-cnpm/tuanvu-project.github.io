@extends('main')

@section('content')

    <!-- Slider -->
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

    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                   <h1>{{ $title }}</h1>
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Lọc
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Tìm kiếm
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form method="GET" action="{{ request()->url() }}">
                        <div class="bor8 dis-flex p-l-15">
                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                
                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" 
                                   type="text" 
                                   name="search-product" 
                                   placeholder="Search" 
                                   value="{{ request('search-product') }}">
                        </div>
                    </form>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sắp Xếp Theo
                            </div>
                    
                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04 {{ request('price') ? '' : 'filter-link-active' }}">
                                        Mặc Định
                                    </a>
                                </li>
                    
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}" class="filter-link stext-106 trans-04 {{ request('price') == 'asc' ? 'filter-link-active' : '' }}">
                                        Giá: Thấp Đến Cao
                                    </a>
                                </li>
                    
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}" class="filter-link stext-106 trans-04 {{ request('price') == 'desc' ? 'filter-link-active' : '' }}">
                                        Giá: Cao Đến Thấp
                                    </a>
                                </li>
                            </ul>
                        </div>
                    
                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Giá
                            </div>
                        
                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'all']) }}" class="filter-link stext-106 trans-04 {{ request('price') == 'all' ? 'filter-link-active' : '' }}">
                                        Tất Cả
                                    </a>
                                </li>
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => '0-100000']) }}" class="filter-link stext-106 trans-04 {{ request('price') == '0-100000' ? 'filter-link-active' : '' }}">
                                        0.00 VNĐ - 100.000 VNĐ
                                    </a>
                                </li>
                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => '100000-500000']) }}" class="filter-link stext-106 trans-04 {{ request('price') == '100000-500000' ? 'filter-link-active' : '' }}">
                                        100.000 VNĐ - 500.000 VNĐ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @include('products.list')

            {!! $products->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@endsection