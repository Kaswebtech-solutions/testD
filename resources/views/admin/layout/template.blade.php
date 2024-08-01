<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark">
            @include('admin.layout.menubar')
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/admin/dashboard') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">Goodsoom Data Sync</span>
            </a>
            <div class="sidebar">
                @include('admin.layout.user_panel')
                @include('admin.layout.sidebar_search')
                @include('admin.layout.sidebar')
            </div>
        </aside>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @include('admin.layout.flash_message')
                    @yield('contents')
                </div>
        </div>
        </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    @include('admin.layout.footer')
</body>
</html>
