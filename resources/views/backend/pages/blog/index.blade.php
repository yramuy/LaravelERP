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
                        <h3 class="card-title">Blog</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a class="btn btn-primary float-right" href="{{ route('blogs.create') }}" id="add-blog">Add
                            Blog</a>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%">ID</th>
                                    <th style="width: 30%">Title</th>
                                    <th style="width: 42%">Description</th>
                                    <th>Status</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="blog-body">

                                @if ($blogs->isNotEmpty())
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->description }}</td>
                                            <td>
                                                <i class='{{$blog->status == 1 ? "fas fa-check-circle text-success active" : "fas fa-minus"}}'></i>
                                            </td>
                                            <td>
                                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-info btn-edit"
                                                    data-edit-id='{{ $blog->id }}' data-toggle="modal1"
                                                    data-target="#serviceModal1"><i class="fas fa-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger ml-2 blog-delete"
                                                    data-delete-id='{{ $blog->id }}'><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Records found!</td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{--  <div class="card-footer">
                        {{ $blogs->links() }}

                    </div>  --}}
                </div>
            </div><!-- /.container-fluid -->

            {{-- Delete Model --}}

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this Blog?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="blogConfirmDeleteButton">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>
@endsection
