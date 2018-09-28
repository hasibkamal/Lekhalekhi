@extends('layout.admin.admin-layout')

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
                    <div class="row">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name">
                        </div>
                    </div>
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

@endsection