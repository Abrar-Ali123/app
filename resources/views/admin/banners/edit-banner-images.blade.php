@extends('manager.layouts.app', ['title' => 'Banner'])

@section('css')
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.banners.index')}}">{{__('admin.banners')}}</a></li>
                            <li class="breadcrumb-item active">{{__('admin.edit')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('admin.edit_banners')}}</h4>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('admin.banner_images')}}</h4>
                            <form action="{{route('admin.banners.store')}}" method="post" class="dropzone" id="myAwesomeDropzone">
                                @csrf

                                 <div class="fallback">
                                    <input name="image" type="file[]" multiple />
                                </div>

                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h3>Drop files here or click to upload.</h3>
                                </div>
                            </form>

                            <!-- Preview -->
                            <div class="dropzone-previews mt-3" id="file-previews"></div>

                        </div><!-- end card-body-->

                        <div class="d-none" id="tpl">
                            <div class="card mt-1 mb-0 shadow-none border dropzone-previews" >
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                        </div>
                                        <div class="col pl-0">
                                            <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                            <p class="mb-0" data-dz-size></p>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>

                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-->
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <!-- file preview template -->



    </div>

@endsection

@section('script')
    <script>
        window.onload = function() {

            var banners = {!! json_encode($banners) !!};
            Dropzone.autoDiscover = false;

            var form = document.getElementById('myAwesomeDropzone');
            var drop = $('#tpl').html();
            var myDropzone = new Dropzone('form#myAwesomeDropzone',{
                previewTemplate:drop,
                previewsContainer:"#file-previews",
                clickable: true,
            });

            for (var i = 0; i < banners.length; i++) {
                var mockFile = {
                    name: banners[i].id,
                    id: banners[i].id,
                    type: 'image/jpeg',
                    status: Dropzone.ADDED,
                    url:  banners[i].url
                };

                // Call the default addedfile event handler
                myDropzone.emit("addedfile", mockFile);

                // And optionally show the thumbnail of the file:
                myDropzone.emit("thumbnail", mockFile, banners[i].url);

                myDropzone.files.push(mockFile);
            }



            myDropzone.on('addedfile',function (file){
                console.log(file);
            });
            myDropzone.on('removedfile',function (file){
                removeImage(file);

            });

            myDropzone.on('success', (file, responseText) => { console.log(file, responseText)});
        };


        function removeImage(file){
            $.ajax({
                url: {!! json_encode(route('admin.banners.destroy'))!!},
                type:"DELETE",
                data:{
                    id:file.id,
                    _token:{!! json_encode(csrf_token()) !!}
                },
                success:function(response){
                    console.log(response);
                },
                error:function (err){
                    console.log(err);
                }

            });
        }

    </script>


    <!-- Page js-->
    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>
@endsection
