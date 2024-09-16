{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> --}}
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://billspayeadmin.in/">Admin.in</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.2.0 -->
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script src="{{ asset('dist/js/ckeditor/ckeditor.js') }}"></script>

{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  --}}
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>

<script type="text/javascript" src="https://unpkg.com/dropzone"></script>
<script type="text/javascript" src="https://unpkg.com/cropperjs"></script>



<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".autoCloseAlert").alert('close');
        }, 3000);


    });
</script>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addSkill').click(function() {
            $('#skillDiv').append(
                "<div class='form-group row removeDiv'><input type='hidden' name='skill_id[]'' value='0'><div class='col-sm-6'><input type='text' class='form-control' name='skill[]'' placeholder='Skill Name'></div><div class='col-sm-3.5'><input type='number' class='form-control' name='percentage[]' placeholder='Percentage'></div><div class='col-sm-2'><button type='button' class='btn btn-danger remove-btn'>-</button></div></div>"
            );
        });

        $('#skillDiv').on('click', '.remove-btn', function() {
            $(this).closest(".removeDiv").remove();

        })

        // JS Validations

        $('#btn-service').click(function() {
            $('#Services_form').submit();
            return false;
        });

        $('#Services_form').validate({
            submitHandler: function() {
                saveService();
            },
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                description: {
                    required: true,
                    minlength: 5,
                    maxlength: 1000
                },
                // icon: {
                //     required: true
                // }
            },

            messages: {
                title: {
                    required: "Please enter a title",
                    minlength: "Title must be at least 3 charactrs long",
                    maxlength: "Title must be less than 100 characters long"
                },
                description: {
                    required: "Please enter a description",
                    minlength: "Description must be at least 5 charactrs long",
                    maxlength: "Description must be less than 1000 characters long"
                },
                // icon: {
                //     required: "Please choose a image"
                // }
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function saveService() {
            var formData = new FormData($('#Services_form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('services') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        LoadServices();
                        $('#success-msg').html(
                            '<div class="alert alert-info autoCloseAlert" role="alert">' +
                            response.success + '</div>');
                        $('#serviceModal').modal('hide');
                        window.setTimeout(function() {
                            $(".autoCloseAlert").alert('close');
                        }, 3000);
                    }
                },

            });
        }

        LoadServices();

        function LoadServices() {
            $.ajax({
                type: "GET",
                url: "{{ route('services') }}",
                success: function(response) {
                    var service = response.services;
                    $('#service-body').html('');
                    if (service.length > 0) {
                        for (let index = 0; index < service.length; index++) {
                            $('#service-body').append('<tr><td>' + (index + 1) + '</td><td>' +
                                service[index].title + '</td><td>' + service[index]
                                .description + '</td><td>' + service[index].icon_name +
                                '</td><td><a href="javascript:void(0)" class="btn btn-info btn-edit" data-edit-id=' +
                                service[index].id +
                                ' data-toggle="modal1" data-target="#serviceModal1"><i class="fas fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger ml-2 btn-delete" data-service-title=' +
                                service[index].title + ' data-delete-id=' +
                                service[index].id +
                                '><i class="fas fa-trash"></i></a></td></tr>');
                        }
                    } else {
                        $('#service-body').append('<tr><td colspan="5">No data found!</td></tr>');
                    }

                    // console.log(response.services)
                }
            });
        }

        $('#add-service').click(function() {
            $('#serviceModal').modal('show');
            $('#exampleModalLabel').text('Add Service');
            $('#btn-service').text('Save');
            $('#icon').attr('required', true);
            $('#image-container').html('');
            $('#service_id').val(0);
            $('#Services_form')[0].reset(); // This will reset the form
        });

        $('#service-body').on('click', '.btn-edit', function() {

            $('#serviceModal').modal('show');

            $('#exampleModalLabel').text('Update Service');
            $('#btn-service').text('Update');

            var id = $(this).attr('data-edit-id');
            $.ajax({
                type: "GET",
                url: "{{ route('serviceData') }}",
                data: {
                    serviceId: id
                },
                success: function(response) {
                    var data = response.service;
                    $('#service_id').val(data.id);
                    $('#title').val(data.title);
                    $('#description').val(data.description);
                    var path = "{{ asset('storage/uploads') }}/" + data.icon_name;
                    $('#image-container').html('<img src="' + path +
                        '" style="width:100%; height:10em;">');

                }
            });
        });

        $('.btn-close').click(function() {
            $('#exampleModalLabel').text('Add Service');
            $('#btn-service').text('Save');
            $('#image-container').html('');
            $('#Services_form')[0].reset(); // This will reset the form

        });
        let deleteId;
        $('#service-body').on('click', '.btn-delete', function() {
            deleteId = $(this).attr('data-delete-id');
            let serviceTitle = $(this).attr('data-service-title');
            $('#deleteModal').modal('show');
            $('#service-title').text(serviceTitle);
        });

        $('#confirmDeleteButton').click(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('delete-service') }}",
                data: {
                    serviceId: deleteId
                },
                success: function(response) {
                    if (response.success) {
                        LoadServices();
                        $('#success-msg').html(
                            '<div class="alert alert-success autoCloseAlert">' +
                            response.success + '</div>');
                        $('#deleteModal').modal('hide');
                        window.setTimeout(function() {
                            $(".autoCloseAlert").alert('close');
                        }, 3000);
                    }
                }
            });
        });

    });

    $('#example').DataTable();


    $('#blogForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the browser

        var formData = new FormData($('#blogForm')[0]); // Serialize the form data
        $.ajax({
            url: '{{ route('blogs.store') }}',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response['errors']);
                if (response['status'] == true) {
                    window.location.href = "{{ route('blogs.index') }}";
                } else {
                    if (response['errors']['title']) {
                        $('#title').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback')
                            .html(response['errors']['title']);
                    } else {
                        $('#title').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    }

                    if (response['errors']['status']) {
                        $('#status').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback')
                            .html(response['errors']['status']);
                    } else {
                        $('#status').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    }

                    if (response['errors']['description']) {
                        $('#description').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback')
                            .html(response['errors']['description']);
                    } else {
                        $('#description').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    }
                    if (response['errors']['file']) {
                        $('#file').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback')
                            .html(response['errors']['file']);
                    } else {
                        $('#file').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    }
                }

            },
            error: function(error) {
                console.log('An error occurred.');
                console.log(error);
            }
        });
    });

    var deleteId;

    $('#blog-body').on('click', '.blog-delete', function() {
        deleteId = $(this).attr('data-delete-id');
        $('#deleteModal').modal('show');

    });

    $('#blogConfirmDeleteButton').click(function() {
        $.ajax({
            url: "{{ route('blogs.delete') }}",
            type: "GET",
            data: {
                id: deleteId
            },
            success: function(response) {
                window.location.href = "{{ route('blogs.index') }}";
            }
        });
    });

    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#images').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            resize.croppie('bind', {
                url: e.target.result
            }).then(function() {
                console.log('success bind image');
            });
        }

        reader.readAsDataURL(this.files[0]);
    });

    $('.image-upload').on('click', function(ev) {
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(img) {
            $.ajax({
                url: '{{ route('image.store') }}',
                type: "POST",
                data: {
                    "image": img
                },
                success: function(data) {
                    html = '<img src="' + img + '" style="margin-left: -64px"/>';
                    $('#show-crop-image').html(html);

                }
            })
        })
    });

    var $modal = $('#modal');

    var image = document.getElementById('sample_image');

    var cropper;

    $('#upload_image').change(function(event) {
        var files = event.target.files;

        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $('#crop').click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {

                var base64data = reader.result;
                $.ajax({
                    url: '{{ route('image.resize-store') }}',
                    method: 'POST',
                    data: {
                        image: base64data
                    },
                    success: function(data) {
                        console.log('response : ' + data);
                        $modal.modal('hide');
                        var path = "{{ asset('image') }}/" + data;
                        $('#uploaded_image').attr('src', path);
                    }
                });
            };
        });
    });
</script>

<script>
    function deleteSkill(id) {
        $.ajax({
            url: "{{ route('deleteSkill') }}",
            type: "GET",
            data: {
                skillId: id
            },
            success: function(res) {
                location.reload();
            }
        });
    }

    $(function() {
        CKEDITOR.replace('long_text');
    });
</script>
