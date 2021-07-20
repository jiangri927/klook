<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Welcome Page Setting</h2>
        <table class="table table-striped my-table">
            <tr>
                <th>Promo</th>
                <th>Other Info</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
            @if(!empty($welcome))
                <tr>
                    <td>{{$welcome->promo?'On':'Off'}}</td>
                    <td>{{$welcome->other_info?'On':'Off'}}</td>
                    <td>
                        @foreach($welcome->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('admin.edit.welcome')}}" class="btn btn-success admin-action">Edit</a>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    <div class="col-md-12 text-center">
        @if(empty($welcome))
            <a href="{{ route('admin.setup.welcome') }}" class="btn btn-save">Setup Welcome Setting</a>
        @endif
    </div>
</div>
<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Main Category</h2>

        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Info</th>
                <th>Promo 1</th>
                <th>Promo 2</th>
                <th>Sub Cateogry</th>
                <th>Index Image</th>
                <th>Banner Images</th>
                <th>Action</th>
            </tr>
            @foreach($category as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->info?'On':'Off'}}</td>
                    <td>{{$item->promo1?'On':'Off'}}</td>
                    <td>{{$item->promo2?'On':'Off'}}</td>
                    <td>{{$item->subCategory->count()}}</td>
                    <td>
                        @if($item->indexImage())
                            <a data-fancybox="gallery" href="{{$item->indexImage()->path}}">{{$item->indexImage()->name}}</a>
                        @endif
                    </td>
                    <td>
                        @foreach($item->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.maincategory.edit', ['category_id' => $item->id]) }}" class="btn btn-success admin-action">Edit</a>
                        <a href="{{ route('admin.maincategory.delete', ['category_id' => $item->id]) }}" class="btn btn-danger admin-action" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-12 text-center">
        <a href="{{ route('admin.create.category') }}" class="btn btn-save">Add New Category</a>
    </div>
</div>
<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Sub Category</h2>

        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Main Category</th>
                <th>Index Image</th>
                <th>Banner Images</th>
                <th>Action</th>
            </tr>
            @foreach($subcategory as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->mainCategory()}}</td>
                    <td>
                        @if($item->indexImage())
                            <a data-fancybox="gallery" href="{{$item->indexImage()->path}}">{{$item->indexImage()->name}}</a>
                        @endif
                    </td>
                    <td>
                        @foreach($item->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.subcategory.edit', ['category_id' => $item->id]) }}" class="btn btn-success admin-action">Edit</a>
                        <a href="{{ route('admin.subcategory.delete', ['category_id' => $item->id]) }}" class="btn btn-danger admin-action" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Region</h2>

        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Region Title</th>
                <th>Region Info</th>
                <th>Index Image</th>
                <th>Banner Images</th>
                <th>Action</th>
            </tr>
            @foreach($region as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->info?'On':'Off'}}</td>
                    <td>
                        @if($item->indexImage())
                            <a data-fancybox="gallery" href="{{$item->indexImage()->path}}">{{$item->indexImage()->name}}</a>
                        @endif
                    </td>
                    <td>
                        @foreach($item->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.region.edit', ['region_id' => $item->id]) }}" class="btn btn-success admin-action">Edit</a>
                        <a href="{{ route('admin.region.delete', ['region_id' => $item->id]) }}" class="btn btn-danger admin-action" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-12 text-center">
        <a href="{{ route('admin.region.add') }}" class="btn btn-save">Add New Region</a>
    </div>
</div>
<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Main Destination</h2>

        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Region Title</th>
                <th>Destination Info</th>
                <th>Index Image</th>
                <th>Banner Images</th>
                <th>Action</th>
            </tr>
            @foreach($main_dest as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->regionTitle()}}</td>
                    <td>{{$item->info?'On':'Off'}}</td>
                    <td>
                        @if($item->indexImage())
                            <a data-fancybox="gallery" href="{{$item->indexImage()->path}}">{{$item->indexImage()->name}}</a>
                        @endif
                    </td>
                    <td>
                        @foreach($item->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.m_dest.edit', ['m_dest_id' => $item->id]) }}" class="btn btn-success admin-action">Edit</a>
                        <a href="{{ route('admin.m_dest.delete', ['m_dest_id' => $item->id]) }}" class="btn btn-danger admin-action" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

</div>
<div class="row" style="padding: 40px 10px;">
    <div class="col-md-12" style="overflow-x:auto;">
        <h2 class="left-br">Sub Destination</h2>

        <table class="table table-striped my-table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Region Title</th>
                <th>Main Dest Title</th>
                <th>Destination Info1</th>
                <th>Destination Info2</th>
                <th>Destination Promo1</th>
                <th>Destination Promo2</th>
                <th>Index Image</th>
                <th>Banner Images</th>
                <th>Action</th>
            </tr>
            @foreach($sub_dest as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->regionTitle()}}</td>
                    <td>{{$item->mTitle()}}</td>
                    <td>{{$item->info1?'On':'Off'}}</td>
                    <td>{{$item->info2?'On':'Off'}}</td>
                    <td>{{$item->promo1?'On':'Off'}}</td>
                    <td>{{$item->promo2?'On':'Off'}}</td>
                    <td>
                        @if($item->indexImage())
                            <a data-fancybox="gallery" href="{{$item->indexImage()->path}}">{{$item->indexImage()->name}}</a>
                        @endif
                    </td>
                    <td>
                        @foreach($item->images as $image)
                            <p><a data-fancybox="gallery" href="{{$image->path}}">{{$image->name}}</a></p>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.s_dest.edit', ['s_dest_id' => $item->id]) }}" class="btn btn-success admin-action">Edit</a>
                        <a href="{{ route('admin.s_dest.delete', ['s_dest_id' => $item->id]) }}" class="btn btn-danger admin-action" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

</div>
