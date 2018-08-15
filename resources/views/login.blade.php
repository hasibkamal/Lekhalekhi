<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lekhalekhi - Login</title>
    {!! Html::style('/assets/admin/vendor/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('/assets/admin/vendor/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('/assets/admin/css/sb-admin.css') !!}
</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Lekhalekhi - Login</div>
        <div class="card-body">
            {{ Form::open(['url'=>'login-check','method'=>'post']) }}
                <div class="form-group {{$errors->has('user_email')?'has-error':''}}">
                    <div class="form-label-group">
                        {!! Form::email('user_email','',['id'=>'inputEmail','placeholder'=>'Email address','class'=>'form-control','autofocus'=>'autofocus']) !!}
                        {!! Form::label('inputEmail','Email address ') !!}
                        {!! $errors->first('user_email','<span class="help-block" style="color:red">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{$errors->has('user_email')?'has-error':''}}">
                    <div class="form-label-group">
                        {!! Form::password('password',['id'=>'inputPassword','class'=>'form-control','placeholder'=>'Password']) !!}
                        {!! Form::label('inputPassword','Password') !!}
                        {!! $errors->first('password','<span class="help-block" style="color:red">:message</span>') !!}
                    </div>
                </div>
                {!! Form::submit('Login',['class'=>'btn btn-primary btn-block']) !!}
            {{ Form::close() }}
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ url('/signup/create') }}">Register an Account</a>
                <a class="d-block small" href="{{ url('/signup/forgot-password') }}">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
{!! Html::script('/assets/admin/vendor/jquery/jquery.min.js') !!}
{!! Html::script('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
{!! Html::script('/assets/admin/vendor/jquery-easing/jquery.easing.min.js') !!}
</body>

</html>
