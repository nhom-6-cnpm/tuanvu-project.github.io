<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <!-- ... other header content ... -->
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <span class="nav-link px-3 text-white">Xin chào, {{ Auth::user()->name }}</span>
            <a class="nav-link px-3" href="/logout">Đăng xuất</a>
        </div>
    </div>
</header> 