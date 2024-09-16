@extends('backend.layout.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">About</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">About</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <div class="mt-1">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger autoCloseAlert">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger autoCloseAlert">{{ session('error') }}</div>
                        @endif

                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('about') }}" id="aboutform" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="profile_id" name="profile_id"
                                    value="{{ $profile->id != '' ? $profile->id : '0' }}">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name <em
                                            class="star">*</em></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $profile->name != '' ? $profile->name : old('name') }}"
                                            placeholder="Name">
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email <em
                                            class="star">*</em></label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $profile->email != '' ? $profile->email : old('email') }}"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Profile Name <em
                                            class="star">*</em></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="profile" name="profile"
                                            value="{{ $profile->profile != '' ? $profile->profile : old('profile') }}"
                                            placeholder="Profile Name">
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number <em
                                            class="star">*</em></label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            value="{{ $profile->phone != '' ? $profile->phone : old('phone') }}"
                                            placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="long_text" name="long_text" row="4">{{ $profile->long_text != '' ? $profile->long_text : old('long_text') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="skill_id[]" value="{{ $skills[0]->id }}">
                                        <input type="text" class="form-control" name="skill[]" placeholder="Skill Name"
                                            value="{{ $skills[0]->skill_name }}">

                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="percentage[]"
                                            placeholder="Percentage" value="{{ $skills[0]->percentage }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-success" id="addSkill">+</button>
                                    </div>
                                </div>
                                <div id="skillDiv">
                                    @if ($skills)
                                        @for ($i = 1; $i < sizeof($skills); $i++)
                                            <div class='form-group row removeDiv'>
                                                <input type="hidden" name="skill_id[]" value="{{ $skills[$i]->id }}">
                                                <div class='col-sm-6'><input type='text' class='form-control'
                                                        name='skill[]' placeholder='Skill Name'
                                                        value="{{ $skills[$i]->skill_name }}"></div>
                                                <div class='col-sm-3.5'><input type='number' class='form-control'
                                                        name='percentage[]' placeholder='Percentage'
                                                        value="{{ $skills[$i]->percentage }}"></div>
                                                <div class='col-sm-2'><button type='button'
                                                        class='btn btn-danger remove-btn'
                                                        onclick="deleteSkill({{ $skills[$i]->id }})">-</button></div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" id="btnCancel" data-dismiss="modal"><a
                                        href=>Cancel</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
