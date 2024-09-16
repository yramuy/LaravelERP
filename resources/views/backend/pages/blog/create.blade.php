@extends('backend.layout.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
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
                        <h3 class="card-title">{{ $id ? 'Edit' : 'Add' }} Blog</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="" id="blogForm" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="blog_id" name="blog_id" value="{{ $id ? $id : '0' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title">Title <em class="star">*</em></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ $id ? $blog->title : '' }}" placeholder="title">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description">Status <em class="star">*</em></label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="">--select--</option>
                                                <option value="1"
                                                    {{ isset($id) && $blog->status == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0"
                                                    {{ isset($id) && $blog->status == '0' ? 'selected' : '' }}>Block
                                                </option>
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description">Description <em class="star">*</em></label>
                                            <textarea class="form-control" id="description" name="description" row="6">{{ $id ? $blog->description : '' }}</textarea>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image">Image <em class="star">*</em></label>
                                            <input type="file" class="form-control" id="file" name="file"
                                                accept="image/*">
                                            <p></p>
                                        </div>
                                        @if ($id)
                                            <div class="mb-3">
                                                <img src='{{ asset("storage/uploads/$blog->image")}}' style="width: 300px; height: 200px" alt="Image"/>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"
                                    id="btn-blog">{{ $id ? 'Update' : 'Save' }}</button>
                                <button type="button" class="btn btn-danger" id="btnCancel" data-dismiss="modal"
                                    onclick="window.location.href='{{ route('blogs.index') }}'">Cancel</button>
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
