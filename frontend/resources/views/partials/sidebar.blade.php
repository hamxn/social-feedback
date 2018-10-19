<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            @if (Admin::user())
            <div class="pull-left image">
                <img src="{{ Admin::user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Admin::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('admin.online') }}</a>
            </div>
            @endif
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('admin.menu') }}</li>

            @if (Admin::user())
            @each('admin::partials.menu', Admin::menu(), 'item')
            @else
            <li>
                <a href="/">
                    <i class="fa fa-bar-chart"></i>
                    <span>Index</span>
                </a>
            </li>
            <li>
                <a href="/reports/completed">
                    <i class="fa fa-check"></i>
                    <span>Đã xử lý</span>
                </a>
            </li>
            <li>
                <a href="/reports/create">
                    <i class="fa fa-file-o"></i>
                    <span>Tạo phản ánh</span>
                </a>
            </li>
            @endif

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>