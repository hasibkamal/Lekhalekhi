@extends('layout.admin.admin-layout')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="float-left"><i class="fas fa-table"></i> Author Category</h5>
            <a href="{{ url('/author-category/create') }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> Create category</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <table id="categoryList" class="table table-bordered"width="100%" cellspacing="0" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Category name</th>
                                    <th>Menu status</th>
                                    <th>Status</th>
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
                var t = $('#categoryList').DataTable({
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
                        url:'{{ url('/author-category/get-list') }}',
                        method:'POST',
                        headers:{
                            'X-CSRF-TOKEN':'{{ csrf_token() }}'
                        }
                    },
                    columns:[
                        {name:'serial',data:'serial'},
                        {name:'category_name',data:'category_name'},
                        {name:'status',data:'status'},
                        // {name:'category_image',data:'category_image'},
                        {name:'menu_status',data:'menu_status'},
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
