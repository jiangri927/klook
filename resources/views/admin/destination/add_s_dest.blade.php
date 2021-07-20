@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                @if(!empty($s_dest))
                    <h2 class="f-bold left-br">Edit Sub Destination {{$s_dest->title}}</h2>
                @else
                    <h2 class="f-bold left-br">Add New Sub Destination</h2>
                @endif
                <h6>The Region Title is {{$region->title}}</h6>
                <h6>The Main Destination Title is {{$m_dest->title}}</h6>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{route('admin.s_dest.save')}}" method="post" id="add_s_dest_form">
                        @csrf
                        @if(!empty($s_dest))
                            <input type="text" name="s_dest_id" value="{{$s_dest->id}}" hidden>
                            @foreach($s_dest->images as $img)
                                <input type="hidden" name="gallery[]" class="image_upload_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach
                        @endif
                        <input type="hidden" name="region_id" value="{{$region->id}}" hidden>
                        <input type="hidden" name="m_dest_id" value="{{$m_dest->id}}" hidden>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Title</h5>
                                <input type="text" name="title" class="form-control" placeholder="Please Enter" value="{{!empty($s_dest)?$s_dest->title:old('title')}}">
                                @error('title')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-6">
                                <h5>Sub Destination Promo 1</h5>
                                <textarea name="promo1" id="promo1-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($s_dest)?$s_dest->promo1:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Sub Destination Promo 2</h5>
                                <textarea name="promo2" id="promo2-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($s_dest)?$s_dest->promo2:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Sub Destination Info 1</h5>
                                <textarea name="info1" id="info1-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($s_dest)?$s_dest->info1:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <h5>Sub Destination Info 2</h5>
                                <textarea name="info2" id="info2-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($s_dest)?$s_dest->info2:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-save admin-action">Save and Add Other</button>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="{{route('admin',['active'=>'category'])}}" class="btn btn-save admin-action">Go to Admin</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pr-side">
                    <form id="s_dest_index_gallery" action="{{ route('admin.upload.gallery',['kind'=>'s_dest','index'=>1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up 1 photo for index. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-gallery-thumbs">
                            @if(!empty($s_dest))
                                @if($s_dest->indexImage())
                                    <li class="thumb" data-id="{{ $s_dest->indexImage()->id }}">
                                        <a data-fancybox="gallery" href="{{$s_dest->indexImage()->path }}">
                                            <img src="{{$s_dest->indexImage()->path }}">
                                        </a>
                                        <i class="fa fa-close " id="remove-button"></i>
                                    </li>
                                @endif
                            @endif
                        </ul>

                    </form>
                </div>
                <div class="pr-side">
                    <form id="s_dest_gallery" action="{{ route('admin.upload.gallery',['kind'=>'s_dest']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap gallery-thumbs">
                            @if(!empty($s_dest))
                                @foreach($s_dest->images as $img)
                                    <li class="thumb" data-id="{{ $img->id }}">
                                        <a data-fancybox="gallery" href="{{$img->path }}">
                                            <img src="{{$img->path }}">
                                        </a>
                                        <i class="fa fa-close " id="remove-button"></i>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('additional_js')
    <script>
        CKEDITOR.replace( 'info1-ckeditor');
        CKEDITOR.replace( 'info2-ckeditor');
        CKEDITOR.replace( 'promo1-ckeditor');
        CKEDITOR.replace( 'promo2-ckeditor');
        $(function () {
            fm_dropzone_main = new Dropzone("#s_dest_index_gallery", {
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
                        $('.index-gallery-thumbs').append(thumb);
                        var imgelement = '<input type="hidden" name="gallery[]" class="image_upload_'+response.id+'" value="'+response.id+'">';
                        $('#add_s_dest_form').append(imgelement);
                    });

                }
            });
            fm_dropzone_main1 = new Dropzone("#s_dest_gallery", {
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
                        $('#add_s_dest_form').append(imgelement);
                    });

                }
            });
            $(document).on('click','#remove-button',function(){
                var id = $(this).parent().data('id');
                $(this).parent().remove();
                $('#add_s_dest_form').find('.image_upload_'+id).remove();
            });
        });
    </script>

@endsection
