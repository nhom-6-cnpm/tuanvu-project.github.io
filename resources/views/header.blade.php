<header class="header-v3">
    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="/" class="logo" style="width: 65px;">
                    <!-- Giảm width xuống một nửa -->
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="/">Trang Chủ</a>
                        </li>

                        {!! $menusHtml !!}

                        <li>
                            <a href="/contact">Liên Hệ</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    @if (Auth::check())
                        <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" 
                            data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    @endif

                    @if (Auth::check())
                        <div class="flex-c-m p-lr-10">
                            <span class="text-white">Xin chào, {{ Auth::user()->name }}</span>
                            <a href="{{ route('logout') }}" class="p-l-10 text-white hov-cl1">Đăng xuất</a>
                        </div>
                    @else
                        <div class="flex-c-m p-lr-10">
                            <a href="{{ route('user.login') }}" class="text-white hov-cl1">Đăng nhập</a>
                            <span class="p-lr-5 text-white">|</span>
                            <a href="{{ route('user.register') }}" class="text-white hov-cl1">Đăng ký</a>
                        </div>
                    @endif
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="/">
                <!-- Đã xóa logo mobile -->
            </a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" 
                data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li class="active-menu">
                <a href="/">Trang Chủ</a>
            </li>

            {!! $menusHtml !!}

            <li>
                <a href="/contact">Liên Hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" action="/search" method="GET">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="keyword" 
                       placeholder="Tìm kiếm sản phẩm..." 
                       required>
            </form>
        </div>
    </div>
</header>