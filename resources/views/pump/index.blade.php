@extends('layouts.navigation')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Petrol Pumps</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Petrol Pumps</li>
                    </ul>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary" style="display: flex" type="button" data-toggle="modal"
                        data-target="#addProductTypeModal">
                        Add New
                    </button>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="save-stage">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Petrol Pumps Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pumps as $pump)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pump->pumb_name }}</td>
                                <td>

                                    <button type="button" class="btn btn-primary edit-pump"
                                        data-id="{{ $pump->id }}"
                                        data-pumb_name="{{ $pump->pumb_name }}">
                                        Edit
                                    </button>


                                    <button class="btn btn-danger delete-pump" data-id="{{ $pump->id }}"
                                        title="Delete" data-toggle="modal" data-target="#confirmationModal">
                                        Delete <i class="fa fa-trash"></i>
                                    </button>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Type Modal -->
    <div class="modal fade" id="addProductTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="addProductTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductTypeModalLabel">Add New Product Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new product type -->
                    <form id="addPetrolPump" action="{{ route('pump.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="pumb_name">Petrol Pump Name</label>
                            <input type="text" class="form-control" id="pumb_name" name="pumb_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Update Product Type Modal -->
    <div class="modal fade" id="updateProductTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="updateProductTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductTypeModalLabel">Update Petrol Pump Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for updating product type -->
                    <form id="updateProductTypeForm" action="{{ route('pump.update', ['id' => $pump->id]) }}"
                        method="POST">
                        {{-- <form id="updateProductTypeForm" action="{{ route('product_type.update', $productType) }}"
                            method="POST"> --}}
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="update_product_type_id" name="id" value="{{ $pump->id }}">
                            <div class="form-group">
                                <label for="update_product_type_name">Petrol Pump Name</label>
                                <input type="text" class="form-control" id="update_product_type_name" name="pumb_name"
                                    value="{{ $pump->pumb_name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Petrol Pump..?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="alertMessage"></p>
                </div>
            </div>
        </div>
    </div>




</section>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('#addPetrolPump').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                $('#addProductTypeModal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred while saving the product type.');
                console.error(xhr.responseText);
            }
        });
    });


$(document).ready(function () {
    
    $('.delete-pump').on('click', function () {
        var productId = $(this).data('id'); 

        $('#confirmDeleteModal').modal('show');
        $('#confirmDelete').on('click', function () {
            $.ajax({
                url: '{{ route("pump.delete") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: [productId]
                },
                success: function (response) {
                    $('#alertMessage').text(response.msg);
                    $('#alertModal').modal('show');

                    if (response.success) {
                        location.reload();
                    } else {
                        setTimeout(function () {
                            $('#alertModal').modal('hide');
                        }, 2000);
                    }
                },
                error: function (xhr, status, error) {
                    $('#alertMessage').text('An error occurred while deleting the product type.');
                    $('#alertModal').modal('show');
                    console.error(xhr.responseText);
                    setTimeout(function () {
                        $('#alertModal').modal('hide');
                    }, 2000);
                }
            });
        });
    });
});


    $('.edit-pump').on('click', function () {
        var pumpId = $(this).data('id');
        var pumpName = $(this).data('pumb_name');
        populateUpdateModal(pumpId, pumpName);
    });

    function populateUpdateModal(id, name) {
        $('#update_product_type_id').val(id);
        $('#update_product_type_name').val(name);
        $('#updateProductTypeForm').attr('action', '/pump/update/' + id); // Dynamically set the form action
        $('#updateProductTypeModal').modal('show');
    }


    $('#updateProductTypeForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#updateProductTypeModal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('An error occurred while saving the product type.');
                console.error(xhr.responseText);
            }
        });
    });
});



</script>