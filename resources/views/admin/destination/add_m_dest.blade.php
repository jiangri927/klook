@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                @if(!empty($m_dest))
                    <h2 class="f-bold left-br">Edit Main Destination {{$m_dest->title}}</h2>
                @else
                    <h2 class="f-bold left-br">Add New Main Destination</h2>
                @endif
                <h6>The Region Title is {{$region->title}}</h6>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{route('admin.m_dest.save')}}" method="post" id="add_m_dest_form">
                        @csrf
                        @if(!empty($m_dest))
                            <input type="text" name="m_dest_id" value="{{$m_dest->id}}" hidden>
                            @foreach($m_dest->images as $img)
                                <input type="hidden" name="gallery[]" class="image_upload_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach
                        @endif
                        <input type="hidden" name="region_id" value="{{$region->id}}" hidden>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Title</h5>
                                <input type="text" name="title" class="form-control" placeholder="Please Enter" value="{{!empty($m_dest)?$m_dest->title:old('title')}}">
                                @error('title')
                                <p class="error-message" role="alert">{{$message}}</p>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-12">
                                <h5>Main Destination Info</h5>
                                <textarea name="info" id="info-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($m_dest)?$m_dest->info:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-save admin-action">Save and Continue</button>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="{{route('admin',['active'=>'category'])}}" class="btn btn-save admin-action">Go to Admin</a>
                            </div>
                            @if(!empty($m_dest))
                                <div class="col-md-6 text-center">
                                    <select name="" id="edit_s_dest" class="btn btn-success admin-action">
                                        <option value="">Edit Sub Destination</option>
                                        @foreach($m_dest->s_dest as $item)
                                            <option value="{{ route('admin.s_dest.edit',['s_dest_id'=>$item->id]) }}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 text-center">
                                    <select name="" id="delete_s_dest" class="btn btn-danger admin-action">
                                        <option value="">Delete Sub Destination</option>
                                        @foreach($m_dest->s_dest as $item)
                                            <option value="{{ route('admin.s_dest.delete',['s_dest_id'=>$item->id]) }}">{{$item->title}}</option>
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
                    <form id="m_dest_index_gallery" action="{{ route('admin.upload.gallery',['kind'=>'m_dest','index'=>1]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 1 photo for index. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap index-gallery-thumbs">
                            @if(!empty($m_dest))
                                @if($m_dest->indexImage())
                                    <li class="thumb" data-id="{{ $m_dest->indexImage()->id }}">
                                        <a data-fancybox="gallery" href="{{$m_dest->indexImage()->path }}">
                                            <img src="{{$m_dest->indexImage()->path }}">
                                        </a>
                                        <i class="fa fa-close " id="remove-button"></i>
                                    </li>
                                @endif
                            @endif
                        </ul>

                    </form>
                </div>
                <div class="pr-side">
                    <form id="m_dest_gallery" action="{{ route('admin.upload.gallery',['kind'=>'m_dest']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h4>Drag and drop, or browse</h4>
                                <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap gallery-thumbs">
                            @if(!empty($m_dest))
                                @foreach($m_dest->images as $img)
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
            fm_dropzone_main = new Dropzone("#m_dest_index_gallery", {
                maxFilesize: 1,
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
                        $('#add_m_dest_form').append(imgelement);
                    });

                }
            });
            fm_dropzone_main1 = new Dropzone("#m_dest_gallery", {
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
                        $('#add_m_dest_form').append(imgelement);
                    });

                }
            });
            $(document).on('click','#remove-button',function(){
                var id = $(this).parent().data('id');
                $(this).parent().remove();
                $('#add_m_dest_form').find('.image_upload_'+id).remove();
            });
            $('#edit_s_dest').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
            $('#delete_s_dest').on('change', function (e) {
                var link = $("option:selected", this).val();
                if (link) {
                    location.href = link;
                }
            });
        });
    </script>

@endsection
