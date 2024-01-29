<aside>
    <nav class="p-3">
        <ul class="list-unstyled">
            <li class="pb-2">
                <a class="{{Route::currentRouteName() === 'admin.home' ? 'active' : ''}}" href="{{ route('admin.home') }}">
                    <span class="text">Home</span>
                    <i class="fs-1 icon fa-solid fa-house"></i>
                </a>
            </li>
            <li class="pb-2">
                <a class="{{Route::currentRouteName() === 'admin.restaurant.index' ? 'active' : ''}}" href="{{ route('admin.restaurant.index') }}">
                    <span class="text">Your Restaurant</span>
                    <i class="fs-1 icon fa-solid fa-utensils"></i>
                </a>
            </li>
            <li class="pb-2">
                <a class="{{Route::currentRouteName() === 'admin.products.index' ? 'active' : ''}}" href="{{ route('admin.products.index') }}">
                    <span class="text">Your Products</span>
                    <i class="fs-1 icon fa-solid fa-book-open"></i>
                </a>
            </li>
            <li class="pb-2">
                <a class="{{Route::currentRouteName() === 'admin.orders.index' ? 'active' : ''}}" href="{{route('admin.orders.index')}}">
                    <span class="text">Your Orders</span>
                    <i class="fs-1 icon fa-solid fa-receipt"></i>
                </a>
            </li>
            <li class="pb-2">
                <a class="{{Route::currentRouteName() === 'admin.statistics.index' ? 'active' : ''}}" href="{{route('admin.statistics.index')}}">
                    <span class="text">Your Statistics</span>
                    <i class="fs-1 icon fa-solid fa-chart-column"></i>
                </a>
            </li>
        </ul>
    </nav>
</aside>
