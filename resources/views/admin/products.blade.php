<div class="row" style="padding: 40px 10px;">
    <div style="overflow-x:auto;">
        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Region</th>
                <th>Main Destination</th>
                <th>Sub Destination</th>
                <th>Main Category</th>
                <th>Sub Category</th>
                <th>Recommend </th>
                <th>Top Things to  </th>
                <th>Reviews</th>
                <th>Booked</th>
                <th>Packages</th>
                <th>Tickets</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="">{{ $item->title }}</a></td>
                    <td>{{ $item->city . ',' . $item->country }}</td>
                    <td>{{ $item->category . '/' . $item->subcategory }}</td>
                    <td>{{ $item->top_thing }}</td>
                    <td>{{ $item->recommend }}</td>
                    <td>{{ $item->reviews }}</td>
                    <td>{{ $item->booked }}</td>
                    <td>
                        @foreach ($item->getPackage as $package)
                            <p><a href="">{{ $package->title }}</a></p>
                        @endforeach
                    </td>
                    <td><a href="{{ route('admin.product.edit', ['product_id' => $item->id]) }}" class="btn btn-success admin-action"
                            style="padding: 0 5px;">Edit</a>
                        <a href="{{ route('admin.product.delete', ['product_id' => $item->id]) }}"
                            class="btn btn-danger admin-action" style="padding: 0 5px;"
                            onclick="return confirm('Are you sure?')">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <a href="{{ route('admin.add.product') }}" class="btn btn-save" style="margin: 40px;">Add New Product</a>
</div>
