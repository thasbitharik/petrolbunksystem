@extends('layouts.navigation')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Sales</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Sales</li>
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
            <div class="alert alert-success" role="alert">
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
                                <th>Pump Name</th>
                                <th>Available Unit</th>
                                <th>Unit Per Amount</th>
                                <th>Sales Unit</th>
                                <th>Sales Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $price)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $price->product_type_name }}</td>
                                <td>{{ $price->pumb_name}}</td>
                                <td>{{ $price->qty }}</td>
                                <td>{{ $price->price_for_unit }}</td>
                                <td>{{ $price->sales_unit }}</td>
                                <td>{{ $price->sales_amount }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-product-type"
                                        data-id="{{ $price->id }}" data-product_name="{{ $price->product_name }}"
                                        data-pump_name="{{ $price->pump_name }}"
                                        data-available_unit="{{ $price->available_unit }}"
                                        data-unit_per_amount="{{ $price->unit_per_amount }}"
                                        data-sales_unit="{{ $price->sales_unit }}"
                                        data-sales_amount="{{ $price->sales_amount }}">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger delete-product-type" data-id="{{ $price->id }}"
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
                    <h5 class="modal-title" id="addProductTypeModalLabel">Add Unit Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProductTypeForm" action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="pump_name">Pump Name</label>
                                    <select class="form-select text-white-dark" name="pump_name" id="pump_name"
                                        required>
                                        <option value="" disabled selected>Select Pump Name</option>
                                        @foreach ($pumpName as $pump)
                                        <option class="pro-type" value="{{ $pump->id }}">{{ $pump->pumb_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <select class="form-select text-white-dark" name="product_name" id="product_name"
                                        required>
                                        <option value="" disabled selected>Select Product Name</option>
                                        @foreach ($pumpName as $product)
                                        <option class="pro-type" value="{{ $product->id }}">{{
                                            $product->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="available_unit">Available Unit</label>
                                    <input type="text" class="form-control" id="available_unit" name="available_unit"
                                        value="{{ $available_unit }}" required>
                                </div> --}}

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="unit_per_amount">Unit Per Amount</label>
                                    <input type="text" class="form-control" id="unit_per_amount" name="unit_per_amount"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="sales_unit">Sales Unit</label>
                                    <input type="text" class="form-control" id="sales_unit" name="sales_unit" required>
                                </div>

                                <div class="form-group">
                                    <label for="sales_amount">Sales Amount</label>
                                    <input type="text" class="form-control" id="sales_amount" name="sales_amount"
                                        required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{--
    <!-- Update Product Type Modal -->
    <div class="modal fade" id="updateProductTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="updateProductTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductTypeModalLabel">Update Unit Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateProductTypeForm" action="{{ route('sales.update', ['id' => $price->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="update_product_type_id">Product Name</label>
                                    <select class="form-select text-white-dark" name="product_type_id"
                                        id="update_product_type_id" required>
                                        <option value="" disabled>Select Product Name</option>
                                        @foreach ($selectProduct as $product)
                                        <option class="pro-type" value="{{ $product->id }}">{{
                                            $product->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_unit_id">Product Unit</label>
                                    <select class="form-select text-white-dark" name="unit_id" id="update_unit_id"
                                        required>
                                        <option value="" disabled selected>Select Product Unit</option>
                                        @foreach ($pricePurchase as $sales_qty)
                                        <option class="pro-type" value="{{ $sales_qty->id }}"
                                            data-unit-value="{{ $sales_qty->qty }}">
                                            {{ $sales_qty->qty }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_purchase_amount_id">Product Purchase Amount</label>
                                    <select class="form-select text-white-dark" name="purchase_amount_id"
                                        id="update_purchase_amount_id" required>
                                        <option value="" disabled selected>Select Amount</option>
                                        @foreach ($pricePurchase as $sales)
                                        <option class="pro-type" value="{{ $sales->id }}"
                                            data-purchase-amount-value="{{ $sales->purchase_amount }}">
                                            {{ $sales->purchase_amount }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="update_price_for_unit">Price Per Unit</label>
                                    <input type="text" class="form-control" id="update_price_for_unit"
                                        name="price_for_unit" required>
                                </div>
                                <div class="form-group">
                                    <label for="update_mrp">MRP Price</label>
                                    <input type="text" class="form-control" id="update_mrp" name="mrp" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}





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
                    Are you sure you want to delete this price ?
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
        e.preventDefault();

        var formData = $(this).serialize();
        console.log('Form data:', formData); 

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                console.log('Form submitted successfully');
                $('#addProductTypeModal').modal('hide');
                location.reload(); 
            },
            error: function (xhr, status, error) {
                console.error('Error occurred:', error);
            }
        });
    });
});
// $('.btn-save').on('click', function () {
//         location.reload();
//     });

$(document).ready(function () {
    
    $('.delete-product-type').on('click', function () {
        var productId = $(this).data('id'); 

        
        $('#confirmDeleteModal').modal('show');

        $('#confirmDelete').on('click', function () {
           
            $.ajax({
                url: '{{ route("sales.delete") }}',
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

});



</script>
{{-- Unit Per Price Calculation --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
      
        var productTypeSelect = document.getElementById("product_type_id");
        var unitSelect = document.getElementById("unit_id");
        var purchaseAmountSelect = document.getElementById("purchase_amount_id");
        var priceInput = document.getElementById("price_for_unit");

        [productTypeSelect, unitSelect, purchaseAmountSelect].forEach(function(select) {
            select.addEventListener("change", calculatePricePerUnit);
        });

        function calculatePricePerUnit() {
            var productTypeId = productTypeSelect.value;
            var unitId = unitSelect.options[unitSelect.selectedIndex].getAttribute('data-unit-value');
            var purchaseAmount = purchaseAmountSelect.options[purchaseAmountSelect.selectedIndex].getAttribute('data-purchase-amount-value');

            productTypeId = parseFloat(productTypeId);
            unitId = parseFloat(unitId);
            purchaseAmount = parseFloat(purchaseAmount);

            var pricePerUnit = purchaseAmount/unitId;

            priceInput.value = pricePerUnit.toFixed(2); 
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listener to edit buttons
        var editButtons = document.querySelectorAll('.edit-product-type');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Retrieve data attributes from the button
                var productTypeId = button.getAttribute('data-product_type_id');
                var unitId = button.getAttribute('data-qty');
                var purchaseAmountId = button.getAttribute('data-purchase_amount');
                var priceForUnit = button.getAttribute('data-price_for_unit');
                var mrp = button.getAttribute('data-mrp');

                // Set values in the update modal fields
                document.getElementById('update_product_type_id').value = productTypeId;
                document.getElementById('update_unit_id').value = unitId;
                document.getElementById('update_purchase_amount_id').value = purchaseAmountId;
                document.getElementById('update_price_for_unit').value = priceForUnit;
                document.getElementById('update_mrp').value = mrp;

                // Show the update modal
                $('#updateProductTypeModal').modal('show');
            });
        });
    });
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
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listener to edit buttons
        var editButtons = document.querySelectorAll('.edit-product-type');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Retrieve data attributes from the button
                var productTypeId = button.getAttribute('data-product_type_id');
                var unitId = button.getAttribute('data-qty');
                var purchaseAmountId = button.getAttribute('data-purchase_amount');
                var priceForUnit = button.getAttribute('data-price_for_unit');
                var mrp = button.getAttribute('data-mrp');

                // Set values in the update modal fields
                document.getElementById('update_product_type_id').value = productTypeId;
                document.getElementById('update_unit_id').value = unitId;
                document.getElementById('update_purchase_amount_id').value = purchaseAmountId;
                document.getElementById('update_price_for_unit').value = priceForUnit;
                document.getElementById('update_mrp').value = mrp;

                // Show the update modal
                $('#updateProductTypeModal').modal('show');
            });
        });

        // Handle form submission for updating product type
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get form element and inputs
        var form = document.getElementById('addProductTypeForm');
        var productNameSelect = document.getElementById('product_type_id');
        var productUnitSelect = document.getElementById('unit_id');
        var purchaseAmountSelect = document.getElementById('purchase_amount_id');
        var priceForUnitInput = document.getElementById('price_for_unit');
        var mrpInput = document.getElementById('mrp');

        // Add submit event listener to the form
        form.addEventListener('submit', function(event) {
            // Check if any of the required fields are empty
            if (!productNameSelect.value || !productUnitSelect.value || !purchaseAmountSelect.value || !priceForUnitInput.value || !mrpInput.value) {
                // Prevent the form from submitting
                event.preventDefault();
                // Show an alert or perform any other action to notify the user
                alert('Please fill in all required fields.');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listener to Sales button
        document.querySelector('.sales-button').addEventListener('click', function() {
            // Get the product type ID and MRP price from the first row of the table
            var productTypeId = document.querySelector('#save-stage tbody tr:first-child td:nth-child(2)').textContent;
            var mrp = document.querySelector('#save-stage tbody tr:first-child td:nth-child(6)').textContent;

            // Redirect to the next blade view with product type ID and MRP price as query parameters
            window.location.href = "{{ route('sales.index') }}" + "?product_type_id=" + productTypeId + "&mrp=" + mrp;
        });
    });
</script>