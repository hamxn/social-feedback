<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Admin::title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! Admin::css() !!}

    <script src="{{ Admin::jQuery() }}"></script>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-fileinput/css/fileinput.min.css?v=4.3.7">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.skinNice.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/dist/css/skins/skin-blue-light.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/laravel-admin/laravel-admin.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/nprogress/nprogress.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/nestable/nestable.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/google-fonts/fonts.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">
<div class="wrapper">

    @include('partials.header')

    @include('partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {!! Admin::script() !!}
    </div>

    @include('admin::partials.footer')

</div>

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
</script>

<!-- REQUIRED JS SCRIPTS -->
{!! Admin::js() !!}

<script src="/vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/dist/js/app.min.js"></script>
<script src="/vendor/laravel-admin/jquery-pjax/jquery.pjax.js"></script>
<script src="/vendor/laravel-admin/nprogress/nprogress.js"></script>
<script src="/vendor/laravel-admin/nestable/jquery.nestable.js"></script>
<script src="/vendor/laravel-admin/toastr/build/toastr.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/vendor/laravel-admin/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/vendor/laravel-admin/laravel-admin/laravel-admin.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="/vendor/laravel-admin/moment/min/moment-with-locales.min.js"></script>
<script src="/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js?v=4.3.7"></script>
<script src="/vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js?v=4.3.7"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script src="/vendor/laravel-admin/number-input/bootstrap-number-input.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/vendor/laravel-admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js"></script>

</body>
</html>
