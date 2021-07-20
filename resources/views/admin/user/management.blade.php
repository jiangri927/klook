<div class="container mt-5 mb-5 ">
    <div style="overflow-x:auto;">
        <h2 class="mb-4 left-br">User Management</h2>
        <table id="user-management-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>UserName</th>
                <th>Email</th>
                <th>User Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
<script type="text/javascript">
    var edit_url = '{{route('admin.edit.user.management')}}';
    $(function () {

        var management_table = $('#user-management-datatable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.get.user') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        management_table.on('click','.edit',function () {
            var user_date = management_table.row($(this).closest('tr')).data();
            var link = edit_url+'/'+user_date.id;
            location.href = link;

        });
        management_table.on('click','.delete',function () {
            if (confirm('Are you sure?')){
                $.ajax({
                    url:'{{route("admin.user.delete")}}',
                    data:{'user_id': management_table.row($(this).closest('tr')).data().id , "_token": "{{ csrf_token() }}",},
                    method:'post',
                    success:function () {
                        management_table.clear().draw();
                    }
                });
            }
            else
                return;
        });

    });
</script>
