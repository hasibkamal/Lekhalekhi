<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Heroic Features - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('/assets/front/vendor/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('/assets/front/css/heroic-features.css') !!}
    @yield('header-css')
</head>

<body>

<!-- Navigation -->
@include('parts.front.topbar')

<!-- Page Content -->
<div class="container">

    @yield('content')
    <!-- /.row -->

</div>
<!-- /.container -->

@include('parts.front.footer')

{!! Html::script('/assets/front/vendor/jquery/jquery.min.js') !!}
{!! Html::script('/assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
@yield('footer-script')
</body>

</html>
