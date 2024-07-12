
$(document).ready(function () {
    $('#addProductTypeForm').on('submit', function (e) {
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
        // Confirm delete action
        $('#confirmDelete').on('click', function () {
            var productId = $('.delete-product-type').data('id');

            // Perform delete action via AJAX
            $.ajax({
                url: '{{ route("product_type.delete") }}',
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


    $('.edit-product-type').on('click', function () {
        var productTypeId = $(this).data('id');
        var productTypeName = $(this).data('product_type_name');
        populateUpdateModal(productTypeId, productTypeName);
    });

    function populateUpdateModal(id, name) {
        $('#update_product_type_id').val(id);
        $('#update_product_type_name').val(name);
        $('#updateProductTypeForm').attr('action', '/product_type/update/' + id); // Dynamically set the form action
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

