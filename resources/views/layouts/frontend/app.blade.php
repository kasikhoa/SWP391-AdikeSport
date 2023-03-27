<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.svg') }}">
    <title>{{ $setting->site_title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bundle/frontend/app.css') }}" type="text/css" />
    @yield('css')
    <style>
        .fa.fa-chevron-down {
            right: 0px;
            margin-left: 2px;
        }
    </style>
</head>

<body>
    <div class="position-fixed p-3 toast-wrapper">
        <div id="liveToastSuccess" class="alert alert-success alert-dismissible" role="alert">
            {{ $success ?? 'Operation successful' }}
            <button type="button" class="close" id="close_success">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="position-fixed p-3 toast-wrapper">
        <div id="liveToastError" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error ?? 'Operation failed' }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endguest
                @auth
                    <a href="/logout">Log out</a>
                    @if (auth()->user()->isAdmin())
                    <script type="text/javascript">
                        window.location = "/dashboard";//here double curly bracket
                    </script>
                    @endif
                @endauth
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{ route('wishlist.index') }}">
                <i class="far fa-heart"></i>
            </a>
            <a href="{{ route('cart.index') }}">
                <i class="fas fa-shopping-bag"></i>
                <span class="badge rounded-pill bg-warning">{{ $cart_amount }}</span>
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="header__top__left">
                            <p>“No pain no gain.”</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @guest
                                    <a href="{{ url('login') }}">Đăng nhập</a>
                                    <a href="{{ route('register') }}">Đăng kí</a>
                                @endguest
                                @auth
                                    <a href="/logout">Đăng xuất</a>
                                    @if (auth()->user()->isAdmin())
                                        <!-- <a href="/dashboard">Dashboard</a> -->
                                        <script type="text/javascript">
                                            window.location = "/dashboard";//here double curly bracket
                                            </script>
                                    @endif
                                @endauth
                            </div>
                            @auth
                                <div class="header__top__hover my-profile">
                                    <span>Thông tin cá nhân<i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                                    <ul>
                                        <li>
                                            <a href="{{ url('edit-profile') }}">Cập nhật thông tin</a>
                                        </li>
                                    </ul>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 d-flex align-items-center">
                    <div class="header__logo">
                        <a href="/">
                            <div class="main">
                                <span>A</span>
                                <span>D</span>
                                <span>I</span>
                                <span>K</span>
                                <span>E</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li @if (url()->current() == url('/')) class="active" @endif>
                                <a href="/">Trang chủ</a>
                            </li>
                            <li @if (url()->current() == url('shop')) class="active" @endif>
                                <a href="{{ route('shop') }}">Shop</a>
                            </li>
                            <li @if (url()->current() == url('all-blogs')) class="active" @endif>
                                <a href="{{ url('all-blogs') }}">Blog</a>
                            </li>
                            <li @if (url()->current() == url('contact/create')) class="active" @endif>
                                <a href="{{ route('contact.create') }}">Liên hệ</a>
                            </li>
                            <!-- <li @if (url()->current() == url('checkout/create')) class="active" @endif>
                                <a href="{{ route('checkout.create') }}">Checkout</a>
                            </li> -->
                            <li class="mobile-only">
                                <a href="{{ url('edit-profile') }}">Thông tin cá nhân</a>
                            </li>
                            <li class="mobile-only">
                                <a href="{{ url('edit-password') }}">Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <!-- <a href="#" class="search-switch">
                            <i class="fa fa-search"></i>
                        </a> -->
                        <a href="{{ route('wishlist.index') }}">
                            <i class="far fa-heart"></i>
                        </a>
                        <a href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-bag"></i>
                            {{-- $cart_amount in AppServiceProvider --}}
                            <span class="badge rounded-pill bg-warning" id="cart_amount">{{ $cart_amount }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="/">
                                <div class="main">
                                    <span>A</span>
                                    <span>D</span>
                                    <span>I</span>
                                    <span>K</span>
                                    <span>E</span>
                                </div>
                            </a>
                        </div>
                        <!-- <p>Khách hàng là trung tâm để chúng tôi phục vụ và p</p> -->
                        <a href="#">
                            <img src="{{ asset('images/details-payment.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Mua sắm</h6>
                        <ul>
                            @foreach ($sub_categories_footer as $item)
                                <li><a
                                        href="{{ route('shop', ['subcategory' => $item->id]) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                            <li><a href="{{ route('shop', ['sale' => 'yes']) }}">Khuyến mãi</a></li>
                            <li><a href="{{ url('order-checking') }}">Tìm kiếm đơn hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Thông tin liên hệ</h6>
                        <ul>
                            <li><a href="{{ route('contact.create') }}">Liên hệ chúng tôi</a></li>
                            <li><a href="tel:0932042076">0925215202</a></li>
                            <li><a href="mailto:tungptse140843@fpt.edu.vn">tungptse140843@fpt.edu.vn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget newslatter">
                        <h6>Gửi Thư</h6>
                        <div class="footer__newslatter">
                            <p>Hãy là người đầu tiên biết gia nhập chúng tôi</p>
                            <form action="#">
                                <input type="text" placeholder="Nhập email">
                                <button type="submit"><i class="fa fa-envelope-square"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">

                </div>
            </div>
        </div>
    </footer>
    <a id="button"></a>
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="{{ route('shop') }}" class="search-model-form">
                <input type="text" id="search-input" placeholder="Tìm kiếm.." name="name" autocomplete="off">
            </form>
        </div>
    </div>

    <script src="{{ asset('bundle/frontend/app.js') }}"></script>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
        <symbol id="star" viewBox="0 0 26 28">
            <path
                d="M26 10.109c0 .281-.203.547-.406.75l-5.672 5.531 1.344 7.812c.016.109.016.203.016.313 0 .406-.187.781-.641.781a1.27 1.27 0 0 1-.625-.187L13 21.422l-7.016 3.687c-.203.109-.406.187-.625.187-.453 0-.656-.375-.656-.781 0-.109.016-.203.031-.313l1.344-7.812L.39 10.859c-.187-.203-.391-.469-.391-.75 0-.469.484-.656.875-.719l7.844-1.141 3.516-7.109c.141-.297.406-.641.766-.641s.625.344.766.641l3.516 7.109 7.844 1.141c.375.063.875.25.875.719z" />
        </symbol>
    </svg>

    @isset($success)
        <script>
            $("#liveToastSuccess").show();
            $("#liveToastSuccess").delay(1500).slideUp(200, function() {
                $(this).hide();
            });

        </script>
    @endisset

    @isset($error)
        <script>
            $("#liveToastError").show();
            $("#liveToastError").delay(1500).slideUp(200, function() {
                $(this).hide();
            });

        </script>
    @endisset

    @yield('script')
</body>

</html>
