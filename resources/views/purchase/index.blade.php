@extends('layouts.navigation')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Purchase </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
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
            <!-- Display success message if any -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Display saved product types in a table -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="save-stage">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Purchase Amount</th>
                                <th>Product Unit</th>
                                <th>Supplier Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productPurchase as $productPump)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $productPump->product_type_name }}</td>
                                <td>{{ $productPump->purchase_amount }}</td>
                                <td>{{ $productPump->qty }}</td>
                                <td>{{ $productPump->supplier_name }}</td>
                                <td>

                                    <button type="button" class="btn btn-primary edit-product-type"
                                    data-id="{{ $productPump->id }}"
                                    data-product_type_id="{{ $productPump->product_type_name }}"
                                    data-qty="{{ $productPump->qty }}"
                                    data-purchase_amount="{{ $productPump->purchase_amount }}"
                                    data-supplier_name="{{ $productPump->supplier_name }}">
                                    Edit
                                </button>
                                
                                    <button class="btn btn-danger delete-product-type" data-id="{{ $productPump->id }}"
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
    <div class="modal fade" id="addProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="addProductTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductTypeModalLabel">Add Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProductTypeForm" action="{{ route('product_purchase.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_type_id">Product Name</label>
                                    <select class="form-select text-white-dark" name="product_type_id" id="product_type_id" required>
                                        <option value="" disabled selected>Select Product Name</option>
                                        @foreach ($selectProduct as $product)
                                        <option class="pro-type" value="{{ $product->id }}">
                                            {{ $product->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty">Unit</label>
                                    <input type="text" class="form-control" id="qty" name="qty" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_amount">Purchase Amount</label>
                                    <input type="text" class="form-control" id="purchase_amount" name="purchase_amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    




    <!-- Update Product Type Modal -->
    <div class="modal fade" id="updateProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="updateProductTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductTypeModalLabel">Update Product Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for updating product type -->
                    <form id="updateProductTypeForm" action="{{ route('product_purchase.update', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="update_product_type_id" name="id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_type_id">Product Name</label>
                                    <select class="form-select text-white-dark" name="product_type_id" id="product_type_id" required>
                                        <option value="" disabled selected>Select Product Name</option>
                                        @foreach ($selectProduct as $prod)
                                            <option name="SelectParent" class="pro-type" value="{{ $prod->id }}" {{ $prod->id == $product->id ? 'selected' : '' }}>
                                                {{ $prod->product_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('SelectParent')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="qty">Unit</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{ $product->qty }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_amount">Purchase Amount</label>
                                    <input type="text" class="form-control" id="purchase_amount" name="purchase_amount" value="{{ $product->purchase_amount }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $product->supplier_name }}" required>
                                </div>
                            </div>
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
                    Are you sure you want to delete this pump product...?
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
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#addProductTypeForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        var formData = $(this).serialize();
        console.log('Form data:', formData); // Log form data for debugging

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                console.log('Form submitted successfully');
                $('#addProductTypeModal').modal('hide');
                location.reload(); // Reload the page after successful submission
            },
            error: function (xhr, status, error) {
                console.error('Error occurred:', error);
            }
        });
    });
});
$('.btn-save').on('click', function () {
        location.reload();
    });

$(document).ready(function () {
    
    $('.delete-product-type').on('click', function () {
        var productId = $(this).data('id'); 

        
        $('#confirmDeleteModal').modal('show');

        // Attach click event handler to the confirm delete button
        $('#confirmDelete').on('click', function () {
            // Perform delete action via AJAX
            $.ajax({
                url: '{{ route("product_purchase.delete") }}',
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



$('.edit-product-type').on('click', function () {
    var productId = $(this).data('id');
    var productType = $(this).data('product_type_id');
    var qty = $(this).data('qty');
    var purchase_amount = $(this).data('purchase_amount');
    var supplier_name = $(this).data('supplier_name');
    populateUpdateModal(productId, productType, qty, purchase_amount, supplier_name);
});
        
        function populateUpdateModal(id, productType, qty, purchaseAmount, supplierName) {
    $('#update_product_type_id').val(id);
    // Set the value of product type dropdown
    $('#product_type_id').val(productType);
    // Set the value of qty input field
    $('#qty').val(qty);
    // Set the value of purchase amount input field
    $('#purchase_amount').val(purchase_amount);
    // Set the value of supplier name input field
    $('#supplier_name').val(supplier_name);

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