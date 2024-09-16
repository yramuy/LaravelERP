@extends('backend.layout.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Resize and Crop Image</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Resize and Crop Image</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <span id="success-msg"></span>
            <div class="container" align="center">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Resize and Crop Image</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h3 align="center">Crop Image in PHP</h3>
                        <br />
                        <div class="row">
                            <div class="col-md-4">&nbsp;</div>
                            <div class="col-md-4">
                                <div class="image_area">
                                    <form method="post">
                                        <label for="upload_image">
                                            <img src="{{ asset('assets/img/myimg1.jpeg')}}" id="uploaded_image" class="img-responsive img-circle" />
                                            <div class="overlay">
                                                <div class="text">Change your DP</div>
                                            </div>
                                            <input type="file" name="image" class="image" id="upload_image"
                                                style="display:none" />
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Crop Image Before Upload</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="" id="sample_image" />
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection
