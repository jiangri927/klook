<div class="container mt-5 mb-5 ">
    <div style="overflow-x:auto;">
        <h2 class="mb-4 left-br">Auto Matching Report</h2>
        <table id="user-am-report-datatable" class="display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Date/Time</th>
                <th>Username</th>
                <th>Order No</th>
                <th>Detail</th>
                <th>Credit</th>
                <th>ABP</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var am_report_table = $('#user-am-report-datatable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.get.am.report') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'created_at', name: 'created_at'},
                {data: 'username', name: 'username'},
                {data: 'order_no', name: 'order_no'},
                {data: 'detail', name: 'detail'},
                {data: 'credit', name: 'credit'},
                {data: 'abp', name: 'abp'},
            ]
        });

    });
</script>
