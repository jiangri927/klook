@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <div class="container">
        <div class="row" style="padding: 40px ;">
            <div class="col-md-12">
                <h2 class="f-bold left-br">Setup Welcome Page</h2>
            </div>
            <div class="col-md-8">
                <div class="pr-main">
                    <form action="{{route('admin.store.welcome')}}" method="post" id="setup_welcome_form">
                        @csrf
                        @if(!empty($welcome))
                            <input type="text" name="id" value="{{$welcome->id}}" hidden>
                            @foreach($welcome->images as $img)
                                <input type="hidden" name="gallery[]" class="image_upload_{{ $img->id }}" value="{{ $img->id }}">
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Promo</h5>
                                <textarea name="promo" id="promo-ckeditor" cols="30" rows="10" class="form-control" >
                                    {{!empty($welcome)?$welcome->promo:''}}
                                </textarea>
                            </div>
                            <div class="col-md-6">
                                <h5>Other Info</h5>
                                <textarea name="other_info" id="info-ckeditor" cols="30" rows="10" class="form-control " >
                                    {{!empty($welcome)?$welcome->other_info:''}}
                                </textarea>
                                <br>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pr-side">
                    <form id="welcome_gallery" action="{{ route('admin.upload.gallery',['kind'=>'welcome']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-wrap">
                            <div class="dz-message "><i class="fa fa-photo"></i>
                                <h2>Drag and drop, or browse</h2>
                                <p>Upload up to 10 photos of what you're selling. Images must be in <b>PNG</b> or <b>JPG</b> format and under 5mb.</p>
                            </div>
                        </div>
                        {{-- thumnail slide  --}}
                        <ul class="thumbs-wrap">
                            @if(!empty($welcome))
                                @foreach($welcome->images as $img)
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
        CKEDITOR.replace( 'promo-ckeditor');
        CKEDITOR.replace( 'info-ckeditor');
        $(function () {
            fm_dropzone_main = new Dropzone("#welcome_gallery", {
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
                        $('.thumbs-wrap').append(thumb);
                        var imgelement = '<input type="hidden" name="gallery[]" class="image_upload_'+response.id+'" value="'+response.id+'">';
                        $('#setup_welcome_form').append(imgelement);
                    });

                }
            });
            $(document).on('click','#remove-button',function(){
                var id = $(this).parent().data('id');
                $(this).parent().remove();
                $('#setup_welcome_form').find('.image_upload_'+id).remove();
            });
        });
    </script>

@endsection
