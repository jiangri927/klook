@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                @if(!empty($region))
                    <h2 class="f-bold left-br">Edit Region {{$region->title}}</h2>

                @else
                    <h2 class="f-bold left-br">Add New Region</h2>
                @endif
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{route('admin.region.save')}}" method="post" id="add_region_form">
                        @csrf
                        @if(!empty($region))
                            <input type="text" name="region_id" value="{{$region->id}}" hidden>
                            @foreach($region->images as $img)
                                <input type="hidden" name="gallery[]" class="image_upload_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Title</h5>
                                <input type="text" name="title" class="form-control" placeholder="Please Enter" value="{{!empty($region)?$region->title:old('title')}}">
                                @error('title')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-12">
                                <h5>Region Info</h5>
                                <textarea name="info" id="info-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($region)?$region->info:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-save admin-action">Save and Continue</button>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="{{route('admin',['active'=>'category'])}}" class="btn btn-save admin-action">Go to Admin</a>
                            </div>
                            @if(!empty($region))
                                <div class="col-md-6 text-center">
                                    <select name="" id="edit_m_dest" class="btn btn-success admin-action">
                                        <option value="">Edit Main Destination</option>
                                        @foreach($region->m_dest as $item)
                                            <option value="{{ route('admin.m_dest.edit',['m_dest_id'=>$item->id]) }}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 text-center">
                                    <select name="" id="delete_m_dest" class="btn btn-danger admin-action">
                                        <option value="">Delete Main Destination</option>
                                        @foreach($region->m_dest as $item)
                                            <option value="{{ route('admin.m_dest.delete',['m_dest_id'=>$item->id]) }}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pr-side">
                    <form id="region_index_gallery" action="{{ route('admin.upload.gallery',['kind'=>'region','index'=>1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up 1 image for index. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-gallery-thumbs">
                            @if(!empty($region))
                                @if($region->indexImage())
                                    <li class="thumb" data-id="{{ $region->indexImage()->id }}">
                                        <a data-fancybox="gallery" href="{{$region->indexImage()->path }}">
                                            <img src="{{$region->indexImage()->path }}">
                                        </a>
                                        <i class="fa fa-close " id="remove-button"></i>
                                    </li>
                                @endif
                            @endif
                        </ul>

                    </form>
                </div>
                <div class="pr-side">
                    <form id="region_gallery" action="{{ route('admin.upload.gallery',['kind'=>'region']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap gallery-thumbs">
                            @if(!empty($region))
                                @foreach($region->images as $img)
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
        CKEDITOR.replace( 'info-ckeditor');
        $(function () {
            fm_dropzone_main = new Dropzone("#region_index_gallery", {
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
                        $('#add_region_form').append(imgelement);
                    });

                }
            });
            fm_dropzone_main1 = new Dropzone("#region_gallery", {
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
                        $('#add_region_form').append(imgelement);
                    });

                }
            });
            $(document).on('click','#remove-button',function(){
                var id = $(this).parent().data('id');
                $(this).parent().remove();
                $('#add_region_form').find('.image_upload_'+id).remove();
            });
            $('#edit_m_dest').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
            $('#delete_m_dest').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
        });
    </script>

@endsection
