@extends('layouts.navigation')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Price Per Unit </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Price Per Unit</li>
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
                                <th>Unit</th>
                                <th>Pump Name</th>
                                <th>Purchase Amount</th>
                                <th>Price For Unit</th>
                                <th>MRP Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unitPrice as $price)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $price->product_type_name }}</td>
                                <td>{{ $price->qty }}</td>
                                <td>{{ $price->pumb_name }}</td>
                                <td>{{ $price->purchase_amount }}</td>
                                <td>{{ $price->price_for_unit }}</td>
                                <td>{{ $price->mrp }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-product-type"
                                        data-id="{{ $price->id }}" data-product_type_id="{{ $price->product_type_id }}"
                                        data-unit_id="{{ $price->unit_id }}" data-pump_id="{{ $price->pump_id }}"
                                        data-purchase_amount_id="{{ $price->purchase_amount_id }}"
                                        data-price_for_unit="{{ $price->price_for_unit }}" data-mrp="{{ $price->mrp }}">
                                        Edit
                                    </button>


                                    <button class="btn btn-danger delete-product-type" data-id="{{ $price->id }}"
                                        title="Delete" data-toggle="modal" data-target="#confirmationModal">
                                        Delete <i class="fa fa-trash"></i>
                                    </button>

                                    {{-- <button type="button" class="btn btn-success btn-sale"
                                        data-id="{{ $price->id }}" data-toggle="modal" data-target="#salesModal">
                                        Sale
                                    </button> --}}
                                    <button type="button" class="btn btn-success btn-sale" data-id="{{ $price->id }}"
                                        data-product-type="{{ $price->product_type_name }}" data-qty="{{ $price->qty }}"
                                        data-pump-name="{{ $price->pumb_name }}"
                                        data-purchase-amount="{{ $price->purchase_amount }}"
                                        data-price-for-unit="{{ $price->price_for_unit }}" data-mrp="{{ $price->mrp }}"
                                        data-toggle="modal" data-target="#salesModal">
                                        Sale
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
                    <form id="addProductTypeForm" action="{{ route('unit_price.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_type_id">Product Name</label>
                                    <select class="form-select text-white-dark" name="product_type_id"
                                        id="product_type_id" required>
                                        <option value="" disabled selected>Select Product Name</option>
                                        @foreach ($selectProduct as $product)
                                        <option class="pro-type" value="{{ $product->id }}">{{
                                            $product->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="unit_id">Product Unit</label>
                                    <select class="form-select text-white-dark" name="unit_id" id="unit_id" required>
                                        <option value="" name="unit_id" disabled selected>Select Product Unit</option>
                                        @foreach ($pricePurchase as $unit_price_qty)
                                        <option class="pro-type" value="{{ $unit_price_qty->id }}"
                                            data-unit-value="{{ $unit_price_qty->qty }}">
                                            {{ $unit_price_qty->qty }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pump_id">Pump For Product</label>
                                    <select class="form-select text-white-dark" name="pump_id" id="pump_id" required>
                                        <option value="" name="pump_id" disabled selected>Select Product Unit</option>
                                        @foreach ($pump as $pname)
                                        <option class="pro-type" value="{{ $pname->id }}"
                                            data-unit-value="{{ $pname->pumb_name }}">
                                            {{ $pname->pumb_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="purchase_amount_id">Product Purchase Amount</label>
                                    <select class="form-select text-white-dark" name="purchase_amount_id"
                                        id="purchase_amount_id" required>
                                        <option value="" disabled selected>Select Amount</option>
                                        @foreach ($pricePurchase as $unit_price)
                                        <option class="pro-type" value="{{ $unit_price->id }}"
                                            data-purchase-amount-value="{{ $unit_price->purchase_amount }}">
                                            {{ $unit_price->purchase_amount }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price_for_unit">Price Per Unit</label>
                                    <input type="text" class="form-control" id="price_for_unit" name="price_for_unit"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="mrp">MRP PRice</label>
                                    <input type="text" class="form-control" id="mrp" name="mrp" required>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Add Modal For Sale --}}
    <div class="modal fade" id="salesModal" tabindex="-1" role="dialog" aria-labelledby="salesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salesModalLabel">Enter Sales Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addsale" action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <!-- Add CSRF token -->

                        <div class="form-group">
                            <label for="pump_id">Pump Name</label>
                            <input type="text" class="form-control" id="pump_name" name="pump_id" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="product_type_id">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_type_id" required
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="available_unit">Avilable Unit</label>
                            <input type="text" class="form-control" id="avilable_unit" name="available_unit" required
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="sales_unit">Sales Unit</label>
                            <input type="text" class="form-control" id="sales_unit" name="sales_unit" required>
                        </div>
                        <div class="form-group">
                            <label for="sales_amount">Sales Amount</label>
                            <input type="text" class="form-control" id="sales_amount" name="sales_amount" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSalesBtn">Save</button>
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
                    <h5 class="modal-title" id="updateProductTypeModalLabel">Update Unit Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateProductTypeForm" action="{{ route('unit_price.update', ['id' => $price->id]) }}"
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
                                        @foreach ($pricePurchase as $unit_price_qty)
                                        <option class="pro-type" value="{{ $unit_price_qty->id }}"
                                            data-unit-value="{{ $unit_price_qty->qty }}">
                                            {{ $unit_price_qty->qty }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pump_id">Pump For Product</label>
                                    <select class="form-select text-white-dark" name="pump_id" id="pump_id" required>
                                        <option value="" name="pump_id" disabled selected>Select Product Unit</option>
                                        @foreach ($pump as $pname)
                                        <option class="pro-type" value="{{ $pname->id }}"
                                            data-unit-value="{{ $pname->pumb_name }}">
                                            {{ $pname->pumb_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="update_purchase_amount_id">Product Purchase Amount</label>
                                    <select class="form-select text-white-dark" name="purchase_amount_id"
                                        id="update_purchase_amount_id" required>
                                        <option value="" disabled selected>Select Amount</option>
                                        @foreach ($pricePurchase as $unit_price)
                                        <option class="pro-type" value="{{ $unit_price->id }}"
                                            data-purchase-amount-value="{{ $unit_price->purchase_amount }}">
                                            {{ $unit_price->purchase_amount }}</option>
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
                url: '{{ route("unit_price.delete") }}',
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
{{-- <script>
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
</script> --}}
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
    $(document).ready(function() {
        $('.btn-sale').on('click', function() {
            var productId = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: '/getSaleData/' + productId,
                success: function(data) {
                    // Populate the form fields with the fetched data
                    $('#sale_unit').val(data.unit);
                    $('#amount').val(data.price);
                }
            });
        });
    });
</script>
{{-- sale Add Form --}}
{{-- <script>
    $(document).ready(function() {
        // Event handler for the "Sale" button
        $('.btn-sale').on('click', function() {
            var salesUnit = $('#sales_unit').val();
            var salesAmount = $('#sales_amount').val();

            // Submit the form data via AJAX
            $.ajax({
                type: 'POST',
                url: '/sales.store',
                data: {
                    sales_unit: salesUnit,
                    sales_amount: salesAmount
                },
                success: function(response) {
                    // Handle success response if needed
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(xhr.responseText);
                }
            });
        });

   

        $('.btn-sale').on('click', function() {
    // Retrieve data attributes
    var productId = $(this).data('id');
    var productType = $(this).data('product-type');
    var qty = $(this).data('qty');
    var pumpName = $(this).data('pump-name');
    var purchaseAmount = $(this).data('purchase-amount');
    var priceForUnit = $(this).data('price-for-unit');
    var mrp = $(this).data('mrp');

    // Use these variables as needed
    console.log("Product ID:", productId);
    console.log("Product Type:", productType);
    console.log("Quantity:", qty);
    console.log("Pump Name:", pumpName);
    console.log("Purchase Amount:", purchaseAmount);
    console.log("Price for Unit:", priceForUnit);
    console.log("MRP:", mrp);

 
    $('#avilable_unit').val(qty); 
    $('#product_name').val(productType);
    $('#pump_name').val(pumpName);
});

    });
</script> --}}
<script>
    $(document).ready(function() {
     // Event handler for the "Sale" button
     $('.btn-sale').on('click', function() {
         // Retrieve data attributes
         var productId = $(this).data('id');
         var productType = $(this).data('product-type');
         var qty = $(this).data('qty');
         var pumpName = $(this).data('pump-name');
         var purchaseAmount = $(this).data('purchase-amount');
         var priceForUnit = $(this).data('price-for-unit');
         var mrp = $(this).data('mrp');
 
         $('#product_name').val(productType);
         $('#avilable_unit').val(qty);
         $('#pump_name').val(pumpName);
 
         // Show the sales modal
         $('#salesModal').modal('show');
     });
 
     // Event handler for the form submission
     $('#addProductTypeForm').on('submit', function(e) {
         e.preventDefault(); // Prevent the default form submission
         
         // Get the form data
         var formData = $(this).serialize();
 
         // Submit the form data via AJAX
         $.ajax({
             type: 'POST',
             url: $(this).attr('action'), // Get the form action attribute
             data: formData,
             success: function(response) {
                 // Handle success response if needed
                 console.log(response);
                 // Close the sales modal after successful save
                 $('#salesModal').modal('hide');
             },
             error: function(xhr, status, error) {
                 // Handle error if needed
                 console.error(xhr.responseText);
             }
         });
     });
 });
 
</script>