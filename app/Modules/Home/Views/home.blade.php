@extends('layout.front.front-layout')
@section('content')


    <!-- Page Features -->
    <div class="row text-center" style="padding-top: 15px;">
        @for($i=0; $i<12; $i++)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
@endsection