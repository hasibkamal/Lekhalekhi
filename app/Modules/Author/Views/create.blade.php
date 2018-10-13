@extends('layout.admin.admin-layout')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-table"></i> Author create</h5>
        </div>
        {{ Form::open(['url'=>'author/store','method'=>'post','enctype'=>'multipart/form-data']) }}
        <div class="card-body">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('author_name')?'has-error':'' }}">
                    {!! Form::label('author_name','Author name') !!}
                    {!! Form::text('author_name','',['class'=>'form-control','placeholder'=>'author name']) !!}
                    {!! $errors->first('author_name','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('author_category_id')?'has-error':'' }}">
                    {!! Form::label('author_category_id','Author category') !!}
                    {!! Form::select('author_category_id',$authorCategories,'',['class'=>'form-control','placeholder'=>'Select one']) !!}
                    {!! $errors->first('author_category_id','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('user_email')?'has-error':'' }}">
                    {!! Form::label('user_email','Author email') !!}
                    {!! Form::text('user_email','',['class'=>'form-control','placeholder'=>'author email']) !!}
                    {!! $errors->first('user_email','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('designation')?'has-error':'' }}">
                    {!! Form::label('designation','Designation') !!}
                    {!! Form::text('designation','',['class'=>'form-control','placeholder'=>'author designation']) !!}
                    {!! $errors->first('designation','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/author/list') }}" class="btn btn-danger float-left">Close</a>
            
            {!! Form::submit('Save',['class'=>'btn btn-primary float-right']) !!}
            <div class="clearfix"></div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
