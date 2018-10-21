@extends('layout.admin.admin-layout')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-table"></i> Author {{ ($viewMode == 'edit')?'Edit':'Open' }}</h5>
        </div>
        {{ Form::open(['url'=>'author/store/'.\App\Libraries\Encryption::encodeId($author->id),'method'=>'post','enctype'=>'multipart/form-data','id'=>'authorForm']) }}
        <div class="card-body">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('author_name')?'has-error':'' }}">
                    {!! Form::label('author_name','Author name') !!}
                    {!! Form::text('author_name',$author->name,['class'=>'form-control','placeholder'=>'author name']) !!}
                    {!! $errors->first('author_name','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('author_category_id')?'has-error':'' }}">
                    {!! Form::label('author_category_id','Author category') !!}
                    {!! Form::select('author_category_id',$authorCategories,$author->author_category_id,['class'=>'form-control','placeholder'=>'Select one']) !!}
                    {!! $errors->first('author_category_id','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('user_email')?'has-error':'' }}">
                    {!! Form::label('user_email','Author email') !!}
                    {!! Form::text('user_email',$author->user_email,['class'=>'form-control','placeholder'=>'author email','readonly'=>'true']) !!}
                    {!! $errors->first('user_email','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('designation')?'has-error':'' }}">
                    {!! Form::label('designation','Designation') !!}
                    {!! Form::text('designation',$author->designation,['class'=>'form-control','placeholder'=>'author designation']) !!}
                    {!! $errors->first('designation','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/author/list') }}" class="btn btn-danger float-left">Close</a>
            @if($viewMode == 'edit')
            {!! Form::submit('Update',['class'=>'btn btn-primary float-right']) !!}
            @endif
            <div class="clearfix"></div>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('footer-script')
    @if($viewMode == 'open')
        <script type="text/javascript">
            $(document).ready(function(){
                $('#authorForm :input').attr('disabled','true');
            });

            // $(document).ready(function(){
            //     var url = document.location.toString();
            //     if (url.match('#')) {
            //         $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
            //         $('.nav-tabs a').removeClass('active');
            //     }
            // });
        </script>

    @endif
@endsection
