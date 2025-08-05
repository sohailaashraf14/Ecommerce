@php use App\Models\CartItem; @endphp
@php use App\Models\Wishlist;
 $wishlistCount = auth()->check() ? Wishlist::where('user_id', auth()->id())->count() : 0;
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Left navbar links --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link d-block d-md-none" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">E-Commerce App</a>
                @else
                    <a href="{{ route('home') }}" class="nav-link">E-Commerce App</a>
                @endif
            @else
                <a href="{{ route('home') }}" class="nav-link">E-Commerce App</a>
            @endauth
        </li>
    </ul>

    {{-- Right navbar links --}}
    <ul class="navbar-nav ml-auto align-items-center">
        @auth
            @if(Auth::user()->role === 'user')
                @php
                    $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');
                @endphp
                <li class="nav-item">
                    <a href="{{ route('user.cart.index') }}" class="nav-link position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="ml-1">Cart</span>
                        @if($cartCount > 0)
                            <span class="badge badge-danger navbar-badge position-absolute"
                                  style="top: 0; right: 0; font-size: 0.75rem;">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.wishlist.index') }}" class="nav-link position-relative">
                        <i class="fas fa-heart"></i>
                        <span class="ml-1">Wishlist</span>
                        @if($wishlistCount > 0)
                            <span class="badge badge-warning navbar-badge position-absolute" style="top: 0; right: 0; font-size: 0.75rem;">
                    {{ $wishlistCount }}
                </span>
                        @endif
                    </a>
                </li>



            @endif



                {{-- User Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                   aria-expanded="false">
                    👋 {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    @if (Route::has('profile.edit'))
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-cog mr-2"></i> Edit Profile
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                        @csrf
                        <button type="submit" class="btn btn-link btn-block text-left text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @else
            {{-- Guest Links --}}
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</nav>
