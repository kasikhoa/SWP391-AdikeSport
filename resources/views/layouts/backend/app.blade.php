<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('images/favicon.svg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->site_title }}</title>
    <link href="{{ asset('backend/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/pages/dashboard1.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body class="skin-purple fixed-layout">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header d-flex justify-content-center">
                    <a class="navbar-brand" href="/">
                        <b>
                            ADIKE
                        </b>
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark"
                                href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                                href="javascript:void(0)">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/{{ $current_user->avatar ?? '' }}">
                                <span class="hidden-md-down">{{ $current_user->name ?? '' }} &nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="{{ url('logout') }}" class="dropdown-item">
                                    <i class="fa fa-power-off"></i> Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @include('layouts.backend.left_sidebar')

        <div class="page-wrapper">
            <div class="container-fluid">

                @yield('content')

                @include('layouts.backend.right_sidebar')
            </div>
        </div>

        <footer class="footer">
        </footer>

    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    @yield('script')
    @isset($success)
        <script>
            $.toast({
                heading: "Success",
                text: @json($success),
                position: "top-right",
                loaderBg: "#ff6849",
                icon: "success",
                hideAfter: 3500,
                stack: 6
            });
        </script>
    @endisset

    @isset($error)
        <script>
            $.toast({
                heading: "Failed",
                text: @json($error),
                position: "top-right",
                loaderBg: "#ff6849",
                icon: "error",
                hideAfter: 3500,
                stack: 6
            });
        </script>
    @endisset
</body>
</html>
