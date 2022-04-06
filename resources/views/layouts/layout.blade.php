<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <title>
        {{ $ApplicationSetting->item_short_name }}
        @if (isset($title) && !empty($title))
            {{ " | ".$title }}
        @endif
    </title>
    @include('thirdparty.css_back')
    @yield('one_page_css')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/layout.js') }}"></script>
    @stack('header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@include('thirdparty.js_back')
@yield('one_page_js')
@include('thirdparty.js_back_footer')
@stack('footer')
</body>
</html>
