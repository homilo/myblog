<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <title>Homilor Blog</title>

    <style type="text/css">
        body {
            background: #000 url('//livingearthapp.com/images/EarthWithStars.jpg') no-repeat center 0px fixed;
            background-size: 1536px 768px;
            color: #fff;
        }
    </style>

    {{ HTML::style('//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/flatly/bootstrap.min.css') }}
    <!-- {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css') }} -->
    {{ HTML::style('css/larabase.css') }}
    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/magicsuggest.min.css') }}

    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}

    @yield('header-js')

</head>
<body>

    @include('layouts/notifications')

    @yield('ajax-notifications')

    <div id="header" style="height: 100px;">
    </div>

    <div class="container top-gap" >
        @include('layouts/navigation')

        <div class="clearfix" style="background-color: #2B3D50;">
            <div class="col-md-9" style="background-color: #FFF;">
                <div style="padding: 20px 20px;">
                    <ul class="breadcrumb">
                        <li class="active"><i class="fa fa-home"></i> Trang chủ</li>
                    </ul>
                    @yield('content')
                </div>
            </div>

            <div class="col-md-3">
                @include('layouts/sidebar')
            </div>
            

        </div>

    </div>

    @include('layouts/footer')

    {{ HTML::script('//cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js', ['async' => 'async']) }}

    @yield('footer-js')

    {{ HTML::script('js/larabase.js') }}
    {{ HTML::script('js/analytics.js', ['async' => 'async']) }}

</body>
</html>
