@extends('layout.admin.admin-layout')
@section('header-css')
    {!! Html::style('/assets/admin/css/bootstrap-datepicker3.css') !!}
@endsection
@section('content')
    @include('parts.admin.message')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-user"></i> User Profile</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="eduInfo-tab" data-toggle="tab" href="#eduInfo" role="tab" aria-controls="eduInfo" aria-selected="false">Educational Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                    {!! Form::open(['url'=>'user/profile/basic-info-save', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
                    <div class="row" style="padding-top: 15px;">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                {!! Form::label('name','Name') !!}
                                {!! Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'name']) !!}
                                {!! $errors->first('name','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('designation')?'has-error':'' }}">
                                {!! Form::label('designation','Designation') !!}
                                {!! Form::text('designation',$user->designation,['class'=>'form-control','placeholder'=>'designation']) !!}
                                {!! $errors->first('designation','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('company_name')?'has-error':'' }}">
                                {!! Form::label('company_name','Company Name') !!}
                                {!! Form::text('company_name',$user->company_name,['class'=>'form-control','placeholder'=>'company name']) !!}
                                {!! $errors->first('company_name','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('years_of_experience')?'has-error':'' }}">
                                {!! Form::label('years_of_experience','Years of experience') !!}
                                {!! Form::text('years_of_experience',$user->years_of_experience,['class'=>'form-control','placeholder'=>'years of experience']) !!}
                                {!! $errors->first('years_of_experience','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="user_photo" value="{{ $user->user_photo }}">
                                {{ Form::label('user_photo', 'Profile Image :') }}
                                <br/><span id="photo_err" class="text-danger" style="font-size: 15px;"></span>
                                <div>
                                    @if(!empty($user->user_photo))
                                        <img src="{{ url('uploads/users/'.$user->user_photo) }}" id="profilePhotoViewer" width="200" height="200" class="img img-responsive rounded-circle">
                                    @else
                                        <img src="{{ url('assets/admin/images/photo.png') }}" id="profilePhotoViewer" width="200" height="200" class="img img-responsive rounded-circle">
                                    @endif
                                </div><br/>
                                <label class="btn btn-primary">
                                    <input onchange="changePhoto(this)" type="file" name="user_photo" style="display: none">
                                    <i class="fa fa-photo"></i> Browse Image
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('category')?'has-error':'' }}">
                                {!! Form::label('category','Category') !!}
                                {!! Form::text('category',$user->category_name,['class'=>'form-control','placeholder'=>'category','disabled'=>'true']) !!}
                                {!! $errors->first('category','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('highest_degree')?'has-error':'' }}">
                                {!! Form::label('highest_degree','Highest Degree') !!}
                                {!! Form::text('highest_degree',$user->highest_degree,['class'=>'form-control','placeholder'=>'highest degree']) !!}
                                {!! $errors->first('highest_degree','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('user_dob')?'has-error':'' }}">
                                {!! Form::label('user_dob','Date of birth') !!}
                                {!! Form::text('user_dob',$user->user_dob,['class'=>'form-control user_dob','placeholder'=>'user dob','autocomplete'=>'off']) !!}
                                {!! $errors->first('user_dob','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('user_phone')?'has-error':'' }}">
                                {!! Form::label('user_phone','Phone') !!}
                                {!! Form::text('user_phone',$user->user_phone,['class'=>'form-control','placeholder'=>'user phone']) !!}
                                {!! $errors->first('user_phone','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('address')?'has-error':'' }}">
                                {!! Form::label('address','Address') !!}
                                {!! Form::textarea('address',$user->address,['class'=>'form-control','placeholder'=>'address','rows'=>'3']) !!}
                                {!! $errors->first('address','<span style="color:red" class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Save',['class'=>'btn btn-primary col-md-3 float-right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>



                <div class="tab-pane fade" id="eduInfo" role="tabpanel" aria-labelledby="eduInfo-tab">


                </div>


                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">


                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-script')
    {!! Html::script('/assets/admin/js/bootstrap-datepicker.min.js') !!}
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

        $(document).ready(function(){
            $('.user_dob').datepicker({
                dateFormat: 'yyyy-mm-dd'
            });
        });


    </script>
@endsection