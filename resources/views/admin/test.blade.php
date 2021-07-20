@extends('layouts.app')
@section('additional_css')

    <link href="{{asset('js/DataTables-1.10.22/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('js/DataTables-1.10.22/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Laravel 7 Yajra Datatables Example</h2>
        <table id="example" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Country</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection



@section('additional_js')
    <script src="{{asset('js/DataTables-1.10.22/js/jquery.dataTables.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {

            var table = $('#example').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.test') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'title', name: 'title'},
                    {data: 'first_name', name: 'first name'},
                    {data: 'second_name', name: 'last name'},
                    {data: 'country', name: 'country'},
                    {data: 'number', name: 'number'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>

@endsection
