<div class="main">
    <ul>
        @if (kvfj(Auth::user()->permissions, 'dashboard'))
            <li class="nav-dashboard">
                <a href="{{ url('/admin')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif
        @if (kvfj(Auth::user()->permissions, 'users_list'))
            <li class="nav-users">
                <a href="{{ url('/admin/users/All')}}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif
        @if (kvfj(Auth::user()->permissions, 'products_list'))
            <li class="nav-products">
                <a href="{{ url('/admin/products')}}">
                    <i class="fas fa-boxes"></i>
                <span>Products</span>
                </a>
            </li>
        @endif
        @if (kvfj(Auth::user()->permissions, 'category_list'))
            <li class="nav-category">
                <a href="{{ url('/admin/categories')}}">
                    <i class="fas fa-folder-open"></i>
                <span>Categories</span>
                </a>
            </li>
        @endif
    </ul>
</div>
