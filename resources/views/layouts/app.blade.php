<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  @include('includes.meta')

  <title>@yield('title') | TI</title>
  <link rel="apple-touch-icon" href="{{ asset('/assets/app-assets/images/ico/cmnp.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/app-assets/images/ico/cmnp.png') }}">
  <link
    href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700') }}"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
    integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  @stack('before-style')
  @include('includes.style')
  @stack('after-style')
</head>

<body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu"
  data-col="2-columns">

  {{-- @routes()
    <script src="{{ asset('') }}assets/dist/js/demo-theme.min.js?1674944402"></script> --}}

  @include('sweetalert::alert')

  @include('components.header')
  @include('components.menu')
  @yield('content')
  @include('components.footer')

  @stack('before-script')
  @include('includes.script')
  @stack('after-script')

</body>

</html>
