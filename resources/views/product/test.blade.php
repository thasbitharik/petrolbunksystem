<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-product-type').on('click', function() {
            var productId = $(this).data('id'); // Get the product type ID from the data attribute

            var confirmDelete = confirm('Are you sure you want to delete this product type?');

            if (confirmDelete) {
                $.ajax({
                    url: '{{ route("product_type.delete") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: [productId]
                    },
                    success: function(response) {
                        $('#alertMessage').text(response.msg);
                        $('#alertModal').modal('show');

                        if (response.success) {
                            // Reload the page after successful deletion
                            location.reload(); 
                        } else {
                            // Close the modal after 2 seconds
                            setTimeout(function() {
                                $('#alertModal').modal('hide');
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#alertMessage').text('An error occurred while deleting the product type.');
                        $('#alertModal').modal('show');
                        console.error(xhr.responseText);

                        // Close the modal after 2 seconds
                        setTimeout(function() {
                            $('#alertModal').modal('hide');
                        }, 2000);
                    }
                });
            }
        });
    });
</script>

<button class="btn btn-danger delete-product-type" data-id="{{ $productType->id }}"
    title="Delete">
    <i class="fa fa-trash"></i>
</button>

public function delete(Request $request)
{
    if ($request->ajax()) {
        try {
            $ids = $request->input('ids'); // Retrieve the IDs of product types to delete from the request data
            $deleted = ProductType::whereIn('id', $ids)->delete(); // Delete the product types

            if ($deleted) {
                // If deletion is successful, return success response
                return response()->json([
                    'success' => true,
                    'msg' => 'Product types deleted successfully.'
                ]);
            } else {
                // If deletion fails, return error response
                return response()->json([
                    'success' => false,
                    'msg' => 'Failed to delete product types.'
                ], 400); // HTTP status code 400 for bad request
            }
        } catch (\Exception $e) {
            // If an exception occurs, log the error and return error response
            \Log::error('Error deleting product types: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'msg' => 'An error occurred while deleting product types. Please try again later.'
            ], 500); // HTTP status code 500 for internal server error
        }
    } else {
        // If the request is not AJAX, return error response
        return response()->json([
            'success' => false,
            'msg' => 'Invalid request. AJAX request expected.'
        ], 400); // HTTP status code 400 for bad request
    }
}