<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Top Universities in India')</title>
    <link type="image/x-icon" rel="shortcut icon" href="{{ asset('images/fevicon.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Website CSS --}}
    <link rel="stylesheet" href="{{ asset('css/website/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/responsive.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    {{-- Page specific CSS (optional) --}}
    @stack('styles')
</head>
<body class="@yield('body-class', 'home-page')">
    {{-- ========== HEADER ========== --}}
    @include('website.partials.header')
    {{-- ========== END HEADER ========== --}}
    {{-- ========== PAGE CONTENT ========== --}}
    @yield('content')
    {{-- ========== END PAGE CONTENT ========== --}}
    {{-- ========== FOOTER ========== --}}
    @include('website.partials.footer')
    {{-- ========== END FOOTER ========== --}}
    {{-- ========== MODALS ========== --}}
    @include('website.partials.modals')
    {{-- ========== END MODALS ========== --}}
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Website JS --}}
    <script src="{{ asset('js/website/custom.js') }}"></script>
    {{-- Page specific JS (optional) --}}
    @stack('scripts')
    <script type="text/javascript">
            $(document).ready(function(){
                $('.menu').click(function(){
                    $('html').toggleClass('show-menu');
                });
                $('.close-button').click(function(){
                    $('html').removeClass('show-menu');
                });
                $(".nav-menu a").each(function(){
                var pathname1 = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
                var pathname = pathname1.replace("#/", "");
                if ( $(this).attr('href') == pathname) { 
                    $(this).parent().addClass('active');
                } 
            });

            $(".nav-menu a").each(function(){
                var pathname1 = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
            // alert(pathname1);
                var pathname = pathname1.replace("#/", "");
                if ( $(this).attr('href').indexOf(pathname1) > -1) { 
                $(this).parent().addClass('active');
                $(this).parent().parent().parent().addClass('active');
            } 
        });
        });
    </script>
</body>
</html>