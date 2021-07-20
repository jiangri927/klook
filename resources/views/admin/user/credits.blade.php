<div class="container mt-5 mb-5 ">
    <div style="overflow-x:auto;">
        <h2 class="mb-4 left-br">User Credits/ABP Banlance</h2>
        <table id="user-credits-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>UserName</th>
                <th>Credit Balance</th>
                <th>ABP Balance</th>
                <th>Auto Matching Status</th>
                <th>AIVA Username</th>
                <th>Action</th>
                <th>Statement</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="modal fade" id="edit-user-credits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User Credits/ABP Balance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('admin.user.aiva.save')}}" method="post">
                            <div class="row">
                                @csrf
                                <input type="text" name="user_id" hidden>
                                <div class="col-md-6">
                                    <h6>UserName</h6>
                                    <input type="text" name="username" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Credits</h6>
                                    <input type="text" name="credits" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>ABP</h6>
                                    <input type="text" name="abp" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Aiva Username</h6>
                                    <input type="text" name="aiva_username" placeholder="Please Enter" class="form-control" >
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Auto Matching Status</h6>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb1" name="am_status" value="Yes"   />
                                        <label for="chb1">Yes</label>
                                    </div>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb2" name="am_status" value="No"  />
                                        <label for="chb2">No</label>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-12 text-center mt-5">
                                    <button type="submit" class="btn btn-success">Save </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function () {

        var credits_table = $('#user-credits-datatable').DataTable({
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
                {data: 'credits', name: 'credits'},
                {data: 'abp', name: 'abp'},
                {data: 'am_status', name: 'am_status'},
                {data: 'aiva_username', name: 'aiva_username'},
                {
                    data: 'edit',
                    name: 'edit',

                },
                {
                    data: 'statement',
                    name: 'statement',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        credits_table.on('click','.edit',function () {
            var user = credits_table.row($(this).closest('tr')).data();
            var edit_credits_modal = $('#edit-user-credits');
            edit_credits_modal.modal('show');
            edit_credits_modal.find('[name=user_id]').val(user.id);
            edit_credits_modal.find('[name=abp]').val(user.abp);
            edit_credits_modal.find('[name=username]').val(user.username);
            edit_credits_modal.find('[name=credits]').val(user.credits);
            edit_credits_modal.find('[name=aiva_username]').val(user.aiva_username);
            if (user.am_status === 'Yes')
                edit_credits_modal.find('#chb1').attr('checked',true);
            else
                edit_credits_modal.find('#chb2').attr('checked',true);

        });
        credits_table.on('click','.delete',function () {
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
