@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                <h2 class="f-bold left-br">Edit Category</h2>
                <h4>Category is {{$category->title}}</h4>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{ route('admin.store.category') }}" method="post" id="add_category_form">
                        @csrf
                        <div class="row">
                            <input type="text" name="category_id" value="{{$category->id}}" hidden>
                            @foreach($category->images as $img)
                                <input type="hidden" name="gallery[]" class="image_upload_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach
                            <div class="col-md-12">
                                <h6>Category Title</h6>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="{{$category->title}}" name="title" required value="{{old('title')?old('title'):$category->title}}">
                                @error('title')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-12">
                                <h5>Info</h5>
                                <textarea name="info" id="info-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                    {{$category->info}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Promo 1</h5>
                                <textarea name="promo1" id="promo1-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                    {{$category->promo1}}
                                </textarea>
                            </div>
                            <div class="col-md-6">
                                <h5>Promo 2</h5>
                                <textarea name="promo2" id="promo2-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                    {{$category->promo2}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-save admin-action">Save and Finish</button>
                            </div>
                            <div class="col-md-6">
                                <select name="" id="edit_subcategory" class="btn btn-save admin-action">
                                    <option value="">Edit SubCategory</option>
                                    @foreach($subcategory as $item)
                                        <option value="{{ route('admin.subcategory.edit',['category_id'=>$item->id]) }}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="col-md-6" style="margin-top: 25px;">
                                <a href="{{route('admin.add.subcategory',['category_id'=>$category->id])}}" class="btn btn-success admin-action">Add New Subcategory</a>
                            </div>
                            <div class="col-md-6" style="margin-top: 25px;">
                                <select name="" id="delete_subcategory" class="btn btn-danger admin-action">
                                    <option value="">Delete SubCategory</option>
                                    @foreach($subcategory as $item)
                                        <option value="{{ route('admin.subcategory.delete',['category_id'=>$item->id]) }}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pr-side">
                    <form id="cateogry_index_gallery" action="{{ route('admin.upload.gallery',['kind'=>'main_category','index'=>1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up 1 Image for Index Image. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-gallery-thumbs">
                            @if($category->indexImage())
                                <li class="thumb" data-id="{{ $category->indexImage()->id }}">
                                    <a data-fancybox="gallery" href="{{$category->indexImage()->path }}">
                                        <img src="{{$category->indexImage()->path }}">
                                    </a>
                                    <i class="fa fa-close " id="remove-button"></i>
                                </li>
                            @endif
                        </ul>

                    </form>
                </div>
                <div class="pr-side">
                    <form id="cateogry_gallery" action="{{ route('admin.upload.gallery',['kind'=>'main_category']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 10 photos . Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap gallery-thumbs">
                            @foreach($category->images as $img)
                                <li class="thumb" data-id="{{ $img->id }}">
                                    <a data-fancybox="gallery" href="{{$img->path }}">
                                        <img src="{{$img->path }}">
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
        CKEDITOR.replace( 'promo1-ckeditor');
        CKEDITOR.replace( 'promo2-ckeditor');
        CKEDITOR.replace( 'info-ckeditor');
        $(function () {
            fm_dropzone_main = new Dropzone("#cateogry_index_gallery", {
                maxFilesize: 10,
                acceptedFiles: "image/png,image/jpeg",
                dataType: 'json',
                init: function () {
                    this.on("complete", function (file) {
                        this.removeFile(file);
                    });
                    this.on("success", function (file,response) {
                        console.log(response);
                        var thumb = '<li class="thumb" data-id="'+response.id+'">' +
                            '<a data-fancybox="gallery" href="'+response.url+'">' +
                            '<img src="'+response.url+'"></a><i class="fa fa-close" id="remove-button"></i></li>';
                        $('.index-gallery-thumbs').append(thumb);
                        var imgelement = '<input type="hidden" name="gallery[]" class="image_upload_'+response.id+'" value="'+response.id+'">';
                        $('#add_category_form').append(imgelement);
                    });

                }
            });
            fm_dropzone_main = new Dropzone("#cateogry_gallery", {
                maxFilesize: 10,
                acceptedFiles: "image/png,image/jpeg",
                dataType: 'json',
                init: function () {
                    this.on("complete", function (file) {
                        this.removeFile(file);
                    });
                    this.on("success", function (file,response) {
                        console.log(response);
                        var thumb = '<li class="thumb" data-id="'+response.id+'">' +
                            '<a data-fancybox="gallery" href="'+response.url+'">' +
                            '<img src="'+response.url+'"></a><i class="fa fa-close" id="remove-button"></i></li>';
                        $('.gallery-thumbs').append(thumb);
                        var imgelement = '<input type="hidden" name="gallery[]" class="image_upload_'+response.id+'" value="'+response.id+'">';
                        $('#add_category_form').append(imgelement);
                    });

                }
            });
            $(document).on('click','#remove-button',function(){
                var id = $(this).parent().data('id');
                console.log(id);
                $(this).parent().remove();
                $('#add_category_form').find('.image_upload_'+id).remove();
            });
            $(document).on('click','.add-subcategory',function () {
                var element = '<input type="text" name="addSub" hidden value="1">'
                $('#add_category_form').append(element);
                $('#add_category_form').submit();
            });
            $('#edit_subcategory').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
            $('#delete_subcategory').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
        });
    </script>

@endsection
