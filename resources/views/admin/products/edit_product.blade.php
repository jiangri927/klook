@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">

                <h2 class="f-bold left-br">Edit Product</h2>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{route('admin.store.product')}}" method="post" id="add_product_form">
                        @csrf
                        @foreach($product->images as $img)
                            <input type="hidden" name="gallery[]" class="image_{{ $img->id }}" value="{{ $img->id }}">
                        @endforeach

                        <div class="row">
                            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                            <div class="col-md-4 ">
                                <h5>Region</h5>
                                <select name="region" id="p_region" class="form-control @error('region') is-invalid @enderror" >
                                    <option value="{{ $product->region }}">{{ $product->region }}</option>
                                    @foreach($region as $item)
                                        <option value="{{$item->title}}" {{old('region')==$item->title?'selected':''}} >{{$item->title}}</option>
                                    @endforeach
                                </select>
                                @error('region')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="col-md-4 ">
                                <h5>Main Destination</h5>
                                <select name="country" id="p_country" class="form-control @error('country') is-invalid @enderror" >
                                    <option value="{{ $product->country }}">{{ $product->country }}</option>
                                </select>
                                @error('country')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="col-md-4 ">
                                <h5>Sub Destination</h5>
                                <select name="city" id="p_city" class="form-control @error('city') is-invalid @enderror" >
                                    <option value="{{ $product->city }}">{{ $product->city }}</option>
                                </select>
                                @error('city')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6 ">
                                <h5>Category</h5>
                                <select name="category" id="p_category" class="form-control @error('category') is-invalid @enderror" >
                                    <option value="{{ $product->category }}">{{ $product->category }}</option>
                                    @foreach($category as $item)
                                        <option value="{{$item->title}}" {{old('category')==$item->title?'selected':''}}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="col-md-6 ">
                                <h5>Subcategory</h5>
                                <select name="subcategory" id="p_subcategory" class="form-control @error('subcategory') is-invalid @enderror" >
                                    <option value="{{ $product->subcategory }}">{{ $product->subcategory }}</option>
                                </select>
                                @error('subcategory')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Product Title</h5>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Please Enter" value="{{old('title')?old('title'):$product->title}}" >
                                @error('title')
                                <p class="error-message" role="alert">
                                    {{$message}}
                                </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Product Status</h5>
                                <div class="icheck-material-teal icheck-inline">
                                    <input type="radio" id="chb1" name="status" value="Active"  {{$product->status == 'Active'?'checked':''}} />
                                    <label for="chb1">Active</label>
                                </div>
                                <div class="icheck-material-teal icheck-inline">
                                    <input type="radio" id="chb2" name="status" value="Inactive" {{$product->status == 'Inactive'?'checked':''}} />
                                    <label for="chb2">Inactive</label>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6" style="display: flex;align-items: center">
                                <input type="checkbox" class="" name="recommend" {{ $product->recommend=='on'?'checked':'' }}>
                                <h5 style="margin: 0">Travelook Recommed</h5>
                                <br>
                            </div>
                            <div class="col-md-6" style="display: flex;align-items: center;">
                                <input type="checkbox" class="" name="top_thing" {{ $product->top_thing=='on'?'checked':'' }}>
                                <h5 style="margin: 0">Top Things To Do</h5>
                            </div>
                            <div class="col-md-12">
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Product Info</h5>
                                <textarea name="info" id="summary-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                    {{old('info')?old('info'):$product->info}}
                                </textarea>
                                <p class="error-message" role="alert">
                                    @error('info')
                                    {{$message}}
                                </p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>What To Look For</h5>
                                <textarea name="look_for" id="look-for-ckeditor" cols="30" rows="10" class="form-control" >
                                {{old('look_for')?old('look_for'):$product->look_for}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Things To Note</h5>
                                <textarea name="things" id="things-ckeditor" cols="30" rows="10" class="form-control">
                                {{old('things')?old('things'):$product->things}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>FAQ</h5>
                                <textarea name="faq" id="faq-ckeditor" cols="30" rows="10" class="form-control">
                                {{old('faq')?old('faq'):$product->faq}}
                                </textarea>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <button class="btn btn-save admin-action">Save Product</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.setup.package',['product_id'=>$product->id]) }}" class="btn btn-success admin-action">Add New Package</a>
                            </div>
                            <div class="col-md-6">
                                <select name="" id="edit_package_select" class="btn btn-info admin-action">
                                    <option value="">Edit Package</option>
                                    @foreach($product->getPackage as $item)
                                        <option value="{{ route('admin.package.edit',['package_id'=>$item->id]) }}">{{ substr($item->title,0,10).'...' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="" id="delete_package_select" class="btn btn-warning admin-action">
                                    <option value="">Delete Package</option>
                                    @foreach($product->getPackage as $item)
                                        <option value="{{ route('admin.package.delete',['package_id'=>$item->id]) }}">{{ substr($item->title,0,10).'...' }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="pr-side">
                    <form id="product_index_upload_form" action="{{ route('admin.product.image.upload',['kind'=>'index']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h2>Drag and drop, or browse</h2>
                                <p>Upload up 1 photo for index image. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-image">
                            @if(!empty($product->firstImage))
                                <li class="thumb" data-id="{{ $product->firstImage->id }}">
                                    <a data-fancybox="gallery" href="{{$product->firstImage->gallery_url }}">
                                        <img src="{{$product->firstImage->gallery_url }}">
                                    </a>
                                    <i class="fa fa-close " id="remove-button"></i>
                                </li>
                            @endif
                        </ul>

                    </form>

                </div>
                <div class="pr-side">
                    <form id="product_thumb_upload_form" action="{{ route('admin.product.image.upload',['kind'=>'banner']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h2>Drag and drop, or browse</h2>
                                <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap banner-image">
                            @foreach($product->images as $img)
                                <li class="thumb" data-id="{{ $img->id }}">
                                    <a data-fancybox="gallery" href="{{$img->gallery_url }}">
                                        <img src="{{$img->gallery_url }}">
                                    </a>
                                    <i class="fa fa-close " id="remove-button"></i>
                                </li>
                            @endforeach
                        </ul>

                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection
@section('additional_js')
    <script>
        CKEDITOR.replace( 'summary-ckeditor');
        CKEDITOR.replace( 'look-for-ckeditor');
        CKEDITOR.replace( 'things-ckeditor');
        CKEDITOR.replace( 'faq-ckeditor');
        var get_city_url = '{{route('get.city')}}';
        var get_country_url = '{{route('get.country')}}';
        var get_subcategory_url = '{{route('get.subcategory')}}';
        var old_city = '{{old('city')}}';
        var old_country = '{{old('old_country')}}';
        var old_subcategory = '{{old('subcategory')}}';
        $(function(){
            $('#edit_package_select').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
            $('#delete_package_select').on('change', function (e) {
                if (confirm('Are you sure?')) {
                    var link = $("option:selected", this).val();
                    if (link) {
                        location.href = link;
                    }
                }
                else return;
            });
        })
    </script>
    <script src="{{asset('js/product.js')}}"></script>

@endsection
