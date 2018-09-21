@extends('layout.admin.admin-layout')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-table"></i> Author category create</h5>
        </div>
        {{ Form::open(['url'=>'author-category/store','method'=>'post','enctype'=>'multipart/form-data']) }}
        <div class="card-body">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('category_name')?'has-error':'' }}">
                    {!! Form::label('category_name','Category name') !!}
                    {!! Form::text('category_name','',['class'=>'form-control','placeholder'=>'category name']) !!}
                    {!! $errors->first('category_name','<span style="color:red" class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('status')?'has-error':'' }}">
                    {!! Form::label('status','Status') !!}
                    {!! Form::select('status',[1=>'Active',0=>'Inactive'],'',['class'=>'form-control','placeholder'=>'Select one']) !!}
                    {!! $errors->first('status','<span style="color:red" class="help-block">:message</span>') !!}
                </div>

                <div class="form-group">
                    {{--<input type="hidden" name="feature_image" value="{{ 1 }}">--}}
                    {{ Form::label('feature_image', 'Feature Image :') }}
                    <br/><span id="photo_err" class="text-danger" style="font-size: 15px;"></span>
                    <div>
                        <img src="{{ url('assets/admin/images/photo.png') }}" id="profilePhotoViewer" width="300" height="250" class="img img-responsive img-thumbnail">
                    </div><br/>
                    <label class="btn btn-primary">
                        <input onchange="changePhoto(this)" type="file" name="feature_image" style="display: none">
                        <i class="fa fa-photo"></i> Browse Feature Image
                    </label>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/author-category/list') }}" class="btn btn-danger float-left">Close</a>
            
            {!! Form::submit('Save',['class'=>'btn btn-primary float-right']) !!}
            <div class="clearfix"></div>
        </div>
        {{ Form::close() }}
    </div>

@endsection

@section('footer-script')
    <script type="text/javascript">
        function changePhoto(input) {
            if (input.files && input.files[0]) {
                $("#photo_err").html('');
                var mime_type = input.files[0].type;
                if(!(mime_type=='image/jpeg' || mime_type=='image/jpg' || mime_type=='image/png')){
                    $("#photo_err").html("Image format is not valid. Only PNG or JPEG or JPG type images are allowed.");
                    return false;
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profilePhotoViewer').attr('src', e.target.result);
                    // console.dir(e);
                    // console.dir(e.target);
                    // console.dir(e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
