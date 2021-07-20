<div class="container mt-5 mb-5 ">
    <div style="overflow-x:auto;">
        <h2 class="mb-4 left-br">Credits History</h2>
        <table id="user-credits-history-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Date/Time</th>
                <th>Order No</th>
                <th>From User</th>
                <th>To User</th>
                <th>Detail</th>
                <th>Amount</th>
                <th>Product Name</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var credits_history_table = $('#user-credits-history-datatable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.get.credits.history') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'date', name: 'date'},
                {data: 'order_id', name: 'order_id'},
                {data: 'from_user', name: 'from_user'},
                {data: 'to_user', name: 'to_user'},
                {data: 'detail', name: 'detail'},
                {data: 'amount', name: 'amount'},
                {data: 'product_name', name: 'product_name'},
            ]
        });

    });
</script>
