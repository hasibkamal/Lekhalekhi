<!DOCTYPE html>
<html>
<head>
	<title>Create Form</title>
	<link rel="stylesheet" type="text/css" href="">
	{!!Html::style('assets/css/bootstrap.min.css')!!}
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h1 class="text-center">Information List</h1>
			@if(Session::has('success'))
			    <div class="alert alert-success text-center">{!! session('success') !!}</div>
			@endif
			<hr/>
			<table class="table table-stripped table-bordered">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Country</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Action</th>
				</tr>
				<?php $i=1; ?>
				@foreach($informations as $info)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $info->name }}</td>
					<td>{{ $info->email }}</td>
					<td>{{ $info->phone }}</td>
					<td>{{ $countries[$info->country] }}</td>
					<td>{{ date('d-M-Y',strtotime($info->created_at)) }}</td>
					<td>{{ $info->updated_at }}</td>
					<td>
						<a href="{{ url('crud/edit/'.$info->id) }}" class="btn btn-xs btn-info">Edit</a>
						<a onclick="return confirm('Are you sure?')" href="{{ url('crud/delete/'.$info->id) }}" class="btn btn-xs btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

	
</body>
</html>