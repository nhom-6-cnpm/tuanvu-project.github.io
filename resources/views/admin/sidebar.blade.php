  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Logout Button -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="nav-link bg-danger w-100">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Đăng xuất</p>
              </button>
            </form>
          </li>
        </ul>
      </nav>

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-3">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="border-bottom mt-3 mb-3"></div>

      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- Danh Mục --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Danh Mục
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/menus/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Danh Mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/menus/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Danh Mục</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Sản Phẩm --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Sản Phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Sản Phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Sản Phẩm</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Slider --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/sliders/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sliders/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Slider</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Camping --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-campground"></i>
              <p>
                Camping
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/campings/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Camping</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/campings/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Camping</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Carrt --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p> Giỏ Hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/customers" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Đơn Hàng</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Liên Hệ --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Liên Hệ
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-danger right">
                  {{ \App\Models\Contact::where('status', 0)->count() }}
                </span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/contacts/list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh Sách Liên Hệ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/contacts/filter?status=0" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liên Hệ Mới</p>
                  <span class="badge badge-danger right">
                    {{ \App\Models\Contact::where('status', 0)->count() }}
                  </span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
