<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="is-login" content="{{ auth()->check() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="/assets/css/plugins/slider-range.css" />
    <link rel="stylesheet" href="/assets/css/main.css?v=5.5" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
</head>

<body>
    @include('components.store-layout.header')
    {{ $slot }}
    @include('components.store-layout.footer')
    <!--@include('components.store-layout.preloader')-->

    <!-- Vendor JS-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/plugins/slick.js"></script>
    <script src="/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="/assets/js/plugins/waypoints.js"></script>
    <script src="/assets/js/plugins/wow.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="/assets/js/plugins/magnific-popup.js"></script>
    <script src="/assets/js/plugins/select2.min.js"></script>
    <script src="/assets/js/plugins/counterup.js"></script>
    <script src="/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="/assets/js/plugins/images-loaded.js"></script>
    <script src="/assets/js/plugins/isotope.js"></script>
    <script src="/assets/js/plugins/scrollup.js"></script>
    <script src="/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="/assets/js/plugins/jquery.elevatezoom.js"></script>
    <script src="/assets/js/plugins/slider-range.js"></script>
    <!-- Template  JS -->
    <script src="/assets/js/main.js?v=5.5"></script>
    <script src="/assets/js/shop.js?v=5.5"></script>
    <script src="/js/cart.js?v=5.5"></script>
</body>

</html>
