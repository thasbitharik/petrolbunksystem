<?php

namespace App\Http\Controllers;

use App\Models\PetrolPumb;
use App\Models\ProductPerUnitPrice;
use App\Models\ProductPurchase;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductUnitPriceController extends Controller
{

    public function index()
    {
        $selectProduct = ProductType::get();
        $pricePurchase = ProductPurchase::get();
        $pump = PetrolPumb::get();

        $unitPrice = DB::table('product_per_unit_prices')->select('product_per_unit_prices.*', 'product_types.product_type_name', 'product_purchases.qty', 'product_purchases.purchase_amount','petrol_pumbs.pumb_name')
            ->leftjoin('product_types', 'product_types.id', 'product_per_unit_prices.product_type_id')
            ->leftjoin('product_purchases', 'product_purchases.id', 'product_per_unit_prices.unit_id')
            ->leftjoin('petrol_pumbs', 'petrol_pumbs.id', 'product_per_unit_prices.pump_id')
            ->get();

        return view('unitprice.index', compact('selectProduct', 'pricePurchase','pump'))->with('unitPrice', $unitPrice);
    }


    public function store(Request $request)
    {
        $unitPrice = new ProductPerUnitPrice();
        $unitPrice->product_type_id = $request->product_type_id;
        $unitPrice->unit_id = $request->unit_id;
        $unitPrice->pump_id = $request->pump_id;
        $unitPrice->purchase_amount_id = $request->purchase_amount_id;
        $unitPrice->price_for_unit = $request->price_for_unit;
        $unitPrice->mrp = $request->mrp;
        $unitPrice->save();

        return redirect()->route('unit_price.index')->with('success', 'Product type successfully created!');
    }


    public function update(Request $request, $id)
    {
        try {
            $unitPrice = ProductPerUnitPrice::find($id);

            // Validate the request data
            $validatedData = $request->validate([
                'product_type_id' => 'required',
                'unit_id' => 'required',
                'purchase_amount_id' => 'required',
                'price_for_unit' => 'required',
                'mrp' => 'required',
                'pump_id' => 'required',
            ]);

            // Update the unit price
            $unitPrice->product_type_id = $validatedData['product_type_id'];
            $unitPrice->unit_id = $validatedData['unit_id'];
            $unitPrice->pump_id = $validatedData['pump_id'];
            $unitPrice->purchase_amount_id = $validatedData['purchase_amount_id'];
            $unitPrice->price_for_unit = $validatedData['price_for_unit'];
            $unitPrice->mrp = $validatedData['mrp'];
            $unitPrice->save();

            return response()->json(['success' => 'Product type successfully updated!']);
        } catch (\Exception $e) {
            \Log::error('Error updating product type: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the product type. Please try again.'], 500);
        }
    }






    public function delete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ids = $request->input('ids');
                $deleted = ProductPerUnitPrice::whereIn('id', $ids)->delete();

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
