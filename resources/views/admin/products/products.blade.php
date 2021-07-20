<div class="container mt-5 mb-5 ">
        <h2 class="mb-4 left-br">Products</h2>
        <table id="products-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Title</th>
                <th>Region</th>
                <th>Main Destination</th>
                <th>Sub Destination</th>
                <th>Main Category</th>
                <th>Sub Category</th>
                <th>Recommend </th>
                <th>Travellers Love </th>
                <th>Reviews</th>
                <th>Booked</th>
                <th>Packages</th>
                <th>Tickets</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <a href="{{route('admin.add.product')}}" class="btn btn-save">Add New Product</a>
</div>
<script type="text/javascript">
    $(function () {

        var products_table = $('#products-datatable').DataTable({

            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.get.products') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'region', name: 'region'},
                {data: 'country', name: 'country'},
                {data: 'city', name: 'city'},
                {data: 'category', name: 'category'},
                {data: 'subcategory', name: 'subcategory'},
                {data: 'recommend', name: 'recommend'},
                {data: 'top_thing', name: 'top_thing'},
                {data: 'reviews', name: 'reviews'},
                {data: 'booked', name: 'booked'},
                {data: 'package', name: 'package'},
                {data: 'ticket', name: 'ticket'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,

                },
            ]
        });

        products_table.on('click','.edit',function () {

            var product_id = products_table.row(this).data().id;
            var link = '{{ route('admin.product.edit') }}';
            location.href = link+'/'+product_id;
        });
        products_table.on('click','.delete',function () {
            if (confirm('Are you sure?')){
                $.ajax({
                    url:'{{ route('admin.product.delete') }}',
                    data:{'product_id':products_table.row(this).data().id , "_token": "{{ csrf_token() }}",},
                    method:'post',
                    success:function () {
                        products_table.clear().draw();
                    }
                });
            }
            else
                return;

        });

    });
</script>
