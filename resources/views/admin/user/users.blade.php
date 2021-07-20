<div class="container mt-5 mb-5 ">
    <div style="overflow-x:auto;">
        <h2 class="mb-4 left-br">User Profile</h2>
        <table id="users-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Country</th>
                <th>UserName</th>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
                <th>Post Code</th>
                <th>Country Code</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>AIVA UserName</th>
                <th>Auto Matching Status</th>
                <th>User Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('admin.user.profile.save')}}" method="post">
                            <div class="row">
                                @csrf
                                <input type="text" name="user_id" hidden>
                                <div class="col-md-6">
                                    <h6>Email</h6>
                                    <input type="text" name="email" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>UserName</h6>
                                    <input type="text" name="username" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>First Name</h6>
                                    <input type="text" name="first_name" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Last Name</h6>
                                    <input type="text" name="second_name" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Country</h6>
                                    <select name="country" id="select_country" class="form-control">
                                        @foreach($country as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>PhoneCode</h6>
                                    <select name="countryCode" id="select_country_code" class="form-control" >
                                        @foreach($country as $item)
                                            <option value="{{$item->phonecode}}">{{$item->name.'--'.$item->phonecode}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Title</h6>
                                    <select name="title" id="" class="form-control" >
                                        <option value="0">Please Select</option>
                                        <option value="Mr" >Mr</option>
                                        <option value="MRS" >MRS</option>
                                        <option value="MISS">MISS</option>
                                    </select>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <h6>Phone Number</h6>
                                    <input type="text" name="number" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>State</h6>
                                    <input type="text" name="state" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>City</h6>
                                    <input type="text" name="city" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Addres</h6>
                                    <input type="text" name="address" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Post Code</h6>
                                    <input type="text" name="postcode" placeholder="Please Enter" class="form-control">
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <h6>Birthday</h6>
                                    <input type="text" name="birthday" placeholder="Please Enter" class="form-control" id="edit_user_birthday">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Aiva Username</h6>
                                    <input type="text" name="aiva_username" placeholder="Please Enter" class="form-control" disabled>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>Auto Matching Status</h6>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb111" name="am_status" value="Yes"   disabled/>
                                        <label for="chb1">Yes</label>
                                    </div>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb222" name="am_status" value="No"  disabled/>
                                        <label for="chb2">No</label>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <h6>User Status</h6>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb1111" name="status" value="Yes"   disabled/>
                                        <label for="chb1">Active</label>
                                    </div>
                                    <div class="icheck-material-teal icheck-inline">
                                        <input type="radio" id="chb2222" name="status" value="No"  disabled/>
                                        <label for="chb2">Inactive</label>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12 text-center mt-5">
                                    <button type="submit" class="btn btn-success">Save Profile</button>
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
        $('#edit_user_birthday').datepicker({
            changeMonth: true,
            changeYear: true
        });
        var table = $('#users-datatable').DataTable({

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
                {data: 'country', name: 'country'},
                {data: 'username', name: 'username'},
                {data: 'title', name: 'title'},
                {data: 'first_name', name: 'first_name'},
                {data: 'second_name', name: 'second_name'},
                {data: 'state', name: 'state'},
                {data: 'city', name: 'city'},
                {data: 'address', name: 'address'},
                {data: 'postcode', name: 'postcode'},
                {data: 'countryCode', name: 'countryCode'},
                {data: 'number', name: 'number'},
                {data: 'email', name: 'email'},
                {data: 'birthday', name: 'birthday'},
                {data: 'aiva_username', name: 'aiva_username'},
                {data: 'am_status', name: 'am_status'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,

                },
            ]
        });

        table.on('click','.edit',function () {
            var user = table.row(this).data();
            var edit_modal = $('#edit-user-modal');
            edit_modal.modal('show');
            edit_modal.find('[name=user_id]').val(user.id);
            edit_modal.find('[name=country]').val(user.country);
            edit_modal.find('[name=username]').val(user.username);
            edit_modal.find('[name=title]').val(user.title);
            edit_modal.find('[name=first_name]').val(user.first_name);
            edit_modal.find('[name=second_name]').val(user.second_name);
            edit_modal.find('[name=countryCode]').val(user.countryCode);
            edit_modal.find('[name=number]').val(user.number);
            edit_modal.find('[name=state]').val(user.state);
            edit_modal.find('[name=city]').val(user.city);
            edit_modal.find('[name=address]').val(user.address);
            edit_modal.find('[name=postcode]').val(user.postcode);
            edit_modal.find('[name=email]').val(user.email);
            edit_modal.find('[name=birthday]').val(user.birthday);
            edit_modal.find('[name=aiva_username]').val(user.aiva_username);
            if (user.am_status === 'Yes')
                edit_modal.find('#chb111').attr('checked',true);
            else
                edit_modal.find('#chb222').attr('checked',true);
            if (user.status === 'Active')
                edit_modal.find('#chb1111').attr('checked',true);
            else
                edit_modal.find('#chb2222').attr('checked',true);
        });
        table.on('click','.delete',function () {
            if (confirm('Are you sure?')){
                $.ajax({
                    url:'{{route("admin.user.delete")}}',
                    data:{'user_id':table.row(this).data().id , "_token": "{{ csrf_token() }}",},
                    method:'post',
                    success:function () {
                        table.clear().draw();
                    }
                });
            }
            else
                return;

        });

    });
</script>
