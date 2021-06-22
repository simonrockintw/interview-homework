<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ __('app.CompanyName') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="/dist/plugins/fontawesome-free/css/all.min.css">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- iCheck --}}
    <link rel="stylesheet" href="/dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    {{-- Theme style --}}
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">

    @yield('style')

    {{-- Others style --}}
{{--    <link rel="stylesheet" href="/css/others.css">--}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('home') }}" class="brand-link">
                <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">{{ __('app.CompanyName') }}</span>
            </a>

            {{-- Sidebar --}}
            <div class="sidebar">

                {{-- Sidebar Menu --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'news') === 0) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (strpos(Route::currentRouteName(), 'news') === 0) ? 'active' : '' }}">
                                <i class="nav-icon far fa-newspaper"></i>
                                <p>
                                    {{ __('app.NewsPage') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('news.index') }}"
                                       class="nav-link {{ (strpos(Route::currentRouteName(), 'news') === 0) ? 'active' : '' }}">
                                        <i class="nav-icon far fa-newspaper"></i>
                                        <p>{{ __('app.News') }}</p>
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

        {{-- Content Wrapper --}}
        <div class="content-wrapper">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('content-header')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ./Content Header --}}

            {{-- Main content --}}
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            {{-- ./Main content --}}

        </div>
        {{-- ./Content Wrapper --}}

    </div>

    @yield('template')

    {{-- jQuery --}}
    <script src="/dist/plugins/jquery/jquery.min.js"></script>
    {{-- jQuery UI 1.11.4 --}}
    <script src="/dist/plugins/jquery-ui/jquery-ui.min.js"></script>
    {{-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- Bootstrap 4 --}}
    <script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{-- AdminLTE App --}}
    <script src="/dist/js/adminlte.js"></script>
    {{-- Jquery-resource --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-resource@1.2.0"></script>

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="/ctl/Toast.js"></script>

    @yield('script')
</body>

</html>
