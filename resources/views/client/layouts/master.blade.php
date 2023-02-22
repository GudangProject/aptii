<!DOCTYPE html>
<html lang="en">
<head>

  {!! Meta::toHtml() !!}

  <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/bootstrap/style.css">
  <!-- Iconfont Css -->
  <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/awesome/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/flaticon/flaticon.css">
  {{-- <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/magnific-popup/magnific-popup.css"> --}}
  <!-- animate.css -->
  <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/animate-css/animate.css">
  <link rel="stylesheet" href="{{ asset('frontend') }}/vendors/animated-headline/animated-headline.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset('frontend') }}/css/woocomerce.css">
  <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
  <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">

  @stack('css')

</head>

<body id="top-header">



@include('client.layouts.header')

{{ $slot }}

@include('client.layouts.footer')





    <!-- Main jQuery -->
    <script src="{{ asset('frontend') }}/vendors/jquery/jquery.js"></script>
    <!-- Bootstrap 5:0 -->
    <script src="{{ asset('frontend') }}/vendors/bootstrap/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/vendors/bootstrap/bootstrap.js"></script>

    <script src="{{ asset('frontend') }}/js/script.js"></script>

    @stack('scripts')
  </body>
  </html>