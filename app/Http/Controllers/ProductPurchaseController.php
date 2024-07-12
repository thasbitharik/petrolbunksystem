<?php

namespace App\Http\Controllers;

use App\Models\ProductPurchase;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPurchaseController extends Controller
{

    public function index()
    {
        $selectProduct = ProductType::get();

        $productPurchase = DB::table('product_purchases')->select('product_purchases.*', 'product_types.product_type_name',)
            ->leftjoin('product_types', 'product_types.id', 'product_purchases.product_type_id')
            ->get();

        return view('purchase.index', compact('selectProduct'))->with('productPurchase', $productPurchase);
    }

    // public function store(Request $request)
    // {
    //     // No validation

    //     $productPurchase = new ProductPurchase();
    //     $productPurchase->product_type_id = $request->input('product_type_id');
    //     $productPurchase->qty = $request->input('qty');
    //     $productPurchase->purchase_amount = $request->input('purchase_amount');
    //     $productPurchase->supplier_name = $request->input('supplier_name');
    //     $productPurchase->save();

    //     return redirect()->route('purchase.index')->with('success', 'Product type successfully created!');
    // }

    public function store(Request $request)
    {
        $productPurchase = new ProductPurchase();
        $productPurchase->product_type_id = $request->product_type_id;
        $productPurchase->qty = $request->qty;
        $productPurchase->purchase_amount = $request->purchase_amount;
        $productPurchase->supplier_name = $request->supplier_name;
        $productPurchase->save();

        return redirect()->route('purchase.index')->with('success', 'Product type successfully created!');
    }


    public function edit($id)
    {
        $productPurchase = ProductPurchase::findOrFail($id);
        return view('pumpsProducts.edit', compact('pumpsProducts'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'product_type_id' => 'required',
                'qty' => 'required',
                'purchase_amount' => 'required',
                'supplier_name' => 'required',

            ]);

            $productPurchase = new ProductPurchase();
            $productPurchase->product_type_id = $validatedData['product_type_id'];
            $productPurchase->qty = $validatedData['qty'];
            $productPurchase->purchase_amount = $validatedData['purchase_amount'];
            $productPurchase->supplier_name = $validatedData['supplier_name'];
            $productPurchase->save();

            return redirect()->route('purchase.index')
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
                $deleted = ProductPurchase::whereIn('id', $ids)->delete();

                if ($deleted) {
                    return response()->json([
                        'success' => true,
                        'msg' => 'Pump types deleted successfully.'
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
