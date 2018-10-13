@extends('layout.admin.admin-layout')

@section('content')
    @include('parts.admin.message')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-table"></i> Author</h5>
            <a href="{{ url('/author/create') }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> Create author</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <table id="authorList" class="table table-bordered"width="100%" cellspacing="0" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Author name</th>
                                    <th>Category name</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    @include('parts.admin.datatable-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(function(){
                var t = $('#authorList').DataTable({
                    columnDefs:[{
                        serachable:false,
                        orderable:false,
                        targets:0
                    }],
                    order: [[0,'asc']],
                    processing:true,
                    serverSide:true,
                    iDisplayLength:15,
                    ajax:{
                        url:'{{ url('/author/get-list') }}',
                        method:'POST',
                        headers:{
                            'X-CSRF-TOKEN':'{{ csrf_token() }}'
                        }
                    },
                    columns:[
                        {name:'serial',data:'serial'},
                        {name:'author_name',data:'author_name'},
                        {name:'category_name',data:'category_name'},
                        {name:'designation',data:'designation'},
                        {name:'user_email',data:'user_email'},
                        {name:'action',data:'action'}
                    ],
                    "aaSorting":[]
                });

                t.on('order.dt search.dt', function () {
                    t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();

            })
        });
    </script>
@endsection
