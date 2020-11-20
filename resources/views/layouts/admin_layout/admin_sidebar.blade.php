<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('images/admin_image/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Cloud-Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image"style="border-radius: 50%;height: 35px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-open ">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.settings') || request()->routeIs('admin.profile') ? 'active': '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Password</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--Sections--}}
                <li class="nav-item has-treeview menu-open ">
                    <a href="#" class="nav-link {{ request()->routeIs('sections.index')
                                                    || request()->routeIs('admin.brands.index')
                                                    || request()->routeIs('categories')
                                                    ||request()->routeIs('admin.edit.category')
                                                    || request()->routeIs('admin.products.create')
                                                    || request()->routeIs('admin.product.edit')
                                                    || request()->routeIs('admin.products.index')
                                                    || request()->routeIs('admin.product.images')
                                                    || request()->routeIs('admin.brands.create')
                                                    || request()->routeIs('admin.brand.edit')
                                                    || request()->routeIs('admin.product.attribute')? 'active': '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Catalogues
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('sections.index') }}" class="nav-link {{ request()->routeIs('sections.index') ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands.index')
                                                                                    || request()->routeIs('admin.brands.create')
                                                                                    || request()->routeIs('admin.brand.edit')
                                                                                    ? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brands</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('categories') }}" class="nav-link {{ request()->routeIs('categories')
                                                                                    ||request()->routeIs('admin.add.edit.category')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products')
                                                                                      || request()->routeIs('admin.products.create')
                                                                                     || request()->routeIs('admin.product.edit')
                                                                                     || request()->routeIs('admin.products.index')
                                                                                     || request()->routeIs('admin.product.images')
                                                                                     || request()->routeIs('admin.product.attribute')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
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
