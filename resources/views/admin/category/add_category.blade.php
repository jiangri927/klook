@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                <h2 class="f-bold left-br">Add New Category</h2>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{ route('admin.store.category') }}" method="post" id="add_category_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Category Title</h6>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Please Enter Category" name="title" required value="{{old('title')}}">
                                @error('title')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <br>
                            </div>
                            <div class="col-md-12">
                                <h5>Info</h5>
                                <textarea name="info" id="info-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Promo 1</h5>
                                <textarea name="promo1" id="promo1-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                            </textarea>
                            </div>
                            <div class="col-md-6">
                                <h5>Promo 2</h5>
                                <textarea name="promo2" id="promo2-ckeditor" cols="30" rows="10" class="form-control @error('info') is-invalid @enderror" >
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-save">Save and Finish</button>
                                <a href="javascript:void(0);"  class="btn btn-save add-subcategory">Save and Add SubCategory</a>
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
                            <div class="dz-message  "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 1 Image For Index Image. Image must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-gallery-thumbs">

                        </ul>

                    </form>
                </div>
                <div class="pr-side">
                    <form id="cateogry_gallery" action="{{ route('admin.upload.gallery',['kind'=>'main_category']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message gallery"><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 10 photos . Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap gallery-thumbs">

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
            fm_dropzone_main = new Dropzone("#cateogry_gallery", {
                maxFilesize: 10,
                acceptedFiles: "image/png,image/jpeg,image/webp",
                dataType: 'json',
                init: function () {
                    this.on("complete", function (file) {
                        this.removeFile(file);
                    });
                    this.on("success", function (file,response) {
                        var thumb = '<li class="thumb" data-id="'+response.id+'">' +
                            '<a data-fancybox="gallery" href="'+response.url+'">' +
                            '<img src="'+response.url+'"></a><i class="fa fa-close" id="remove-button"></i></li>';
                        $('.gallery-thumbs').append(thumb);
                        var imgelement = '<input type="hidden" name="gallery[]" class="image_upload_'+response.id+'" value="'+response.id+'">';
                        $('#add_category_form').append(imgelement);
                    });

                }
            });
            fm_dropzone_main = new Dropzone("#cateogry_index_gallery", {
                maxFilesize: 1,
                acceptedFiles: "image/png,image/jpeg,image/webp",
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
            })
        });
    </script>

@endsection
