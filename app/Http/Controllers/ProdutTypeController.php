<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProdutTypeController extends Controller
{

    public function index()
    {
        $productTypes = ProductType::all();
        return view('product.index')->with('productTypes', $productTypes);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_type_name' => 'required|string|max:255',
        ]);

        $productType = new ProductType();
        $productType->product_type_name = $validatedData['product_type_name'];
        $productType->save();
        return redirect()->route('product_type.index')
            ->with('success', 'Product type successfully created!');
    }

    public function edit($id)
    {
        $productType = ProductType::findOrFail($id);
        return view('product_type.edit', compact('productType'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'product_type_name' => 'required|string|max:255',
            ]);

            $productType = ProductType::findOrFail($id);

            $productType->product_type_name = $validatedData['product_type_name'];
            $productType->save();

            return redirect()->route('product_type.index')
                ->with('success', 'Product type successfully updated!');
        } catch (\Exception $e) {
            \Log::error('Error updating product type: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while updating the product type. Please try again.');
        }
    }



    public function delete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ids = $request->input('ids');
                $deleted = ProductType::whereIn('id', $ids)->delete();

                if ($deleted) {
                    return response()->json([
                        'success' => true,
                        'msg' => 'Product types deleted successfully.'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'msg' => 'Failed to delete product types.'
                    ], 400);
                }
            } catch (\Exception $e) {
                \Log::error('Error deleting product types: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'msg' => 'An error occurred while deleting product types. Please try again later.'
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Invalid request. AJAX request expected.'
            ], 400);
        }
    }
}