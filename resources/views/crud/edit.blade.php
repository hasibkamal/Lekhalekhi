<!DOCTYPE html>
<html>
<head>
	<title>Create Form</title>
	<link rel="stylesheet" type="text/css" href="">
	{!!Html::style('assets/css/bootstrap.min.css')!!}
</head>
<body>
	<div class="container">
		
		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center">Create form</h1>
			<hr/>
			{{ Form::open(['url'=>'crud/update/'.$info->id,'method'=>'post']) }}
			{!! Form::text('name',$info->name,['placeholder'=>'name','class'=>'form-control form-group']) !!}
			{!! Form::email('email',$info->email,['placeholder'=>'email','class'=>'form-control form-group']) !!}
			{!! Form::text('phone',$info->phone,['placeholder'=>'phone','class'=>'form-control form-group']) !!}
			{!! Form::select('country',$countries,$info->country,['placeholder'=>'Select one','class'=>'form-control form-group']) !!}
			{!! Form::submit('Submit',['class'=>'btn btn-primary pull-right btn-block']) !!}
		{{ Form::close() }}
		</div>
	</div>

	
</body>
</html>