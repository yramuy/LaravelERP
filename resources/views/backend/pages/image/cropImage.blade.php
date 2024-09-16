@extends('backend.layout.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Crop Image</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Crop Image</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <span id="success-msg"></span>
            <div class="container-fluid">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Crop Image</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="" id="cropImageForm" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="cropImage_id" name="cropImage_id" value="">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div id="upload-demo"></div>
                                    </div>
                                    <div class="col-md-4" style="padding:5%;">
                                        <strong>Select image for crop:</strong>
                                        <input type="file" id="images" name="image">

                                    </div>
                                    <div class="col-md-4">
                                        <div id="show-crop-image"
                                            style="background: #e2e2e2;width:310px;padding:59px 69px;height:400px;">

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary image-upload" id="btn-cropImage">Upload Image</button>
                                <button type="button" class="btn btn-danger" id="btnCancel" data-dismiss="modal"
                                    onclick="window.location.href='{{ route('image.create')}}'">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection
