<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" >
                        <i class="icon-speedometer"></i>
                        <span class="hide-menu">Bảng điều khiển</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="far fa-newspaper"></i>
                        <span class="hide-menu">Blogs</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('tags.index') }}">Danh sách thẻ</a></li>
                        <li><a href="{{ route('tags.create') }}">Tạo thẻ mới</a></li>
                        <li><a href="{{ route('blogs.index') }}">Danh sách Blogs</a></li>
                        <li><a href="{{ route('blogs.create') }}">Tạo Blog mói</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="ti-layout-grid2"></i>
                        <span class="hide-menu">Loại sản phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('categories.index') }}">Danh sách loại sản phẩm</a></li>
                        <li><a href="{{ route('categories.create') }}">Tạo loại sản phẩm mới</a></li>
                        <li><a href="{{ route('sub-categories.index') }}">Danh sách danh mục sản phẩm</a></li>
                        <li><a href="{{ route('sub-categories.create') }}">Tạo danh mục sản phẩm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fas fa-toolbox"></i>
                        <span class="hide-menu">Thuộc tính sản phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('sizes.index') }}">Danh sách kích cỡ</a></li>
                        <li><a href="{{ route('sizes.create') }}">Tạo kích cỡ</a></li>
                        <li><a href="{{ route('colors.index') }}">Danh sách màu sắc</a></li>
                        <li><a href="{{ route('colors.create') }}">Tạo màu sắc</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="ti-shopping-cart"></i>
                        <span class="hide-menu">Sản phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('products.index') }}">Danh sách sản phẩm</a></li>
                        <li><a href="{{ route('products.create') }}">Tạo sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="hide-menu">Đơn hàng</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
