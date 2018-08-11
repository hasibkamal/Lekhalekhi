<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Blank Page</title>
    <!-- Bootstrap core CSS-->
    {!! Html::style('/assets/admin/vendor/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('/assets/admin/vendor/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('/assets/admin/vendor/datatables/dataTables.bootstrap4.css') !!}
    {!! Html::style('/assets/admin/css/sb-admin.css') !!}
    @yield('header-css')
</head>

<body id="page-top">
@include('parts.admin.topbar')
<div id="wrapper">
    <!-- Sidebar -->
    @include('parts.admin.sidebar')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('parts.admin.footer')
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
@include('parts.admin.bottom    ')
<!-- Bootstrap core JavaScript-->
{!! Html::script('/assets/admin/vendor/jquery/jquery.min.js') !!}
{!! Html::script('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
{!! Html::script('/assets/admin/vendor/jquery-easing/jquery.easing.min.js') !!}
{!! Html::script('/assets/admin/js/sb-admin.min.js') !!}
@yield('footer-script')
</body>
</html>
