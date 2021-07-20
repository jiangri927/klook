@extends('layouts.app')
@section('additional_css')
    <link rel="stylesheet" href="{{asset('css/product.css')}}">



@endsection
@section('content')

    <div class="container">
        <div class="admin-container">
            <div class="profile-contents">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='users'?'active':'' }}" id="user-tab" href="#users" aria-controls="users"
                           data-toggle="tab" role="tab" aria-selected="true">User Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='management'?'active':'' }}" id="management-tab" href="#management" aria-controls="management"
                           data-toggle="tab" role="tab" aria-selected="true">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='credits'?'active':'' }}" id="credits-tab" href="#credits" aria-controls="credits"
                           data-toggle="tab" role="tab" aria-selected="true">Credits/ABP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='credits_history'?'active':'' }}" id="credits-history-tab" href="#credits-history" aria-controls="credits-history"
                           data-toggle="tab" role="tab" aria-selected="true">Credits History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='abp_history'?'active':'' }}" id="abp-history-tab" href="#abp-history" aria-controls="abp-history"
                           data-toggle="tab" role="tab" aria-selected="true">ABP History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='report'?'active':'' }}" id="report-tab" href="#report" aria-controls="report"
                           data-toggle="tab" role="tab" aria-selected="true">Auto Matching Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='products'?'active':'' }}" id="products-tab" href="#products" aria-controls="products"
                           data-toggle="tab" role="tab" aria-selected="true">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active=='category'?'active':'' }}" id="category-tab" href="#category" aria-controls="category"
                           data-toggle="tab" role="tab" aria-selected="true">Setting</a>
                    </li>

                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade {{ $active=='users'?'active':'' }} show" id="users" role="tabpanel" aria-labelledby="users-tab">
                        No user , yet
                    </div>
                    <div class="tab-pane fade {{ $active=='management'?'active':'' }} show" id="management" role="tabpanel" aria-labelledby="management-tab">
                        No user , yet
                    </div>
                    <div class="tab-pane fade {{ $active=='credits'?'active':'' }} show" id="credits" role="tabpanel" aria-labelledby="credits-tab">
                        No User Credits/ABP , yet
                    </div>
                    <div class="tab-pane fade {{ $active=='credits_history'?'active':'' }} show" id="credits-history" role="tabpanel" aria-labelledby="credits-history-tab">
                        No Credits History , yet
                    </div>
                    <div class="tab-pane fade {{ $active=='abp_history'?'active':'' }} show" id="abp-history" role="tabpanel" aria-labelledby="abp-history-tab">
                        No ABP History , yet
                    </div>
                    <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                        No Auto Matching Report , yet
                    </div>
                    
                    <div class="tab-pane fade  show {{ $active=='products'?'active':'' }}" id="products" role="tabpanel" aria-labelledby="products-tab">
                        No Products History , yet
                    </div>
                    <div class="tab-pane fade show {{ $active=='category'?'active':'' }}" id="category" role="tabpanel" aria-labelledby="category-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additional_js')

    <script>
        var admin_detail_url = '{{ route('admin.detail') }}';
        var editor;
        $(function () {
            $.ajax({
                url: admin_detail_url,
                type: "get",
                datatype: "json",
                data: {},
                success:function(data) {
                    $('#users').html(data.users_html);
                    $('#management').html(data.management_html);
                    $('#credits').html(data.credits_html);
                    $('#credits-history').html(data.credits_history_html);
                    $('#abp-history').html(data.abp_history_html);
                    $('#report').html(data.report_html);
                    $('#products').html(data.products_html);
                    $('#category').html(data.category_html);
                }
            });
        });
    </script>
@endsection
