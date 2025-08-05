<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">🛒 E-Commerce App</span>
            </a>
        @endif
        @if(Auth::user()->role === 'user')
                <a href="{{ route('home') }}" class="brand-link text-center">
                    <span class="brand-text font-weight-light">🛒 E-Commerce App</span>
                </a>
        @endif
    @endauth


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">

                @auth
                    @if(Auth::user()->role === 'admin')
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Products -->
                        <li class="nav-item has-treeview {{ request()->routeIs('admin.products.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Products
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Products</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-box"></i>
                                        <p>
                                            Add Product
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach ($sidebar_categories as $sidebarCategory)
                                            <li class="nav-item">
                                                <a href="{{ route('admin.products.create', ['category' => $sidebarCategory->id]) }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $sidebarCategory->name }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index', 1) }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit Product</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View/Edit Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <!-- Logout -->
                        <li class="nav-item mt-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100 text-start">
                                    <i class="nav-icon fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endif
                        @if(Auth::user()->role === 'user')


                            <div class="sidebar">
                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

                                        <!-- Edit Profile -->
                                        <li class="nav-item">
                                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('user.profile.edit') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-user-edit"></i>
                                                <p>Edit Profile</p>
                                            </a>
                                        </li>

                                        <!-- Categories Dropdown -->
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-tags"></i>
                                                <p>
                                                    Categories
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @foreach ($sidebar_categories as $cat)
                                                    <li class="nav-item">
                                                        <a href="{{ url('/?category=' . $cat->id) }}" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>{{ $cat->name }}</p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.cart.index') }}">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>My Cart</span>
                                            </a>
                                        </li>


                                        <!-- Logout -->
                                        <li class="nav-item mt-3 mr-3">
                                            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Logout and return to welcome page?')">
                                                @csrf
                                                <button class="btn btn-danger w-100 text-start">
                                                    <i class="nav-icon fas fa-sign-out-alt me-2"></i> Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @endif
                @endauth

                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-in-alt"></i>
                            <p>Login</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Register</p>
                        </a>
                    </li>
                @endguest

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
