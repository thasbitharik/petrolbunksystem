<?php

namespace App\Http\Controllers;

use App\Models\PetrolPumb;
use App\Models\Sales;
use App\Models\ProductType;
use App\Models\ProductPerUnitPrice;
use App\Models\ProductPurchase;
use App\Models\PumbProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index(Request $request)
    {
        // $productType = ProductType::get();
        // $pumpName = DB::table('pumb_product_types')
        //     ->select('pumb_product_types.*', 'product_types.product_type_name', 'petrol_pumbs.pumb_name')
        //     ->leftjoin('petrol_pumbs', 'petrol_pumbs.id', 'pumb_product_types.pumb_id')
        //     ->leftjoin('product_types', 'product_types.id', 'pumb_product_types.product_type_id')
        //     ->get();


        // $selectPumpProduct = PumbProductType::get();
        // $priceUnit = ProductPerUnitPrice::get();
        // $purchase = ProductPurchase::get();
        // $latestPurchase = ProductPurchase::latest()->first();

        // $productId = $request->input('product_id');

        // // Retrieve the sales details along with the related product type
        // $salesDetails = Sales::with('productType')
        //     ->where('product_name', $productId)
        //     ->latest()
        //     ->first();


        $sales = DB::table('sales')
            ->select(
                'sales.*',
                // 'pumb_product_types.price',
                // 'product_purchases.qty',
                // 'product_per_unit_prices.price_for_unit',
                // 'petrol_pumbs.pumb_name',
                // 'product_types.product_type_name'
            )
            // ->leftJoin('pumb_product_types', 'pumb_product_types.id', '=', 'sales.product_name')
            // ->leftJoin('product_purchases', 'product_purchases.id', '=', 'sales.available_unit')
            // ->leftJoin('product_per_unit_prices', 'product_per_unit_prices.id', '=', 'sales.unit_per_amount')
            // ->leftJoin('petrol_pumbs', 'petrol_pumbs.id', '=', 'pumb_product_types.pumb_id')
            // ->leftjoin('product_types', 'product_types.id', 'pumb_product_types.product_type_id')
            ->get();

        return view(
            'sales.index',
            //  compact('selectPumpProduct', 'priceUnit', 'productType', 'pumpName', 'purchase',)
        )
            ->with('sales', $sales);
    }



    public function store(Request $request)
    {
        $unitPrice = new Sales();
        $unitPrice->product_type_id = $request->product_type_id;
        $unitPrice->pump_id = $request->pump_id;
        $unitPrice->available_unit = $request->available_unit;
        $unitPrice->sales_unit = $request->sales_unit;
        $unitPrice->sales_amount = $request->sales_amount;
        $unitPrice->save();

        return redirect()->route('sales.index')->with('success', 'Sale  successfully created!');
    }
    

    public function update(Request $request, $id)
    {
        $unitPrice = Sales::findOrFail($id);
        $unitPrice->sales_unit = $request->sales_unit;
        $unitPrice->sales_amount = $request->sales_amount;
        $unitPrice->save();

        return redirect()->route('unit_price.index')->with('success', 'Sale  successfully updated!');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            try {
                $ids = $request->input('ids');
                $deleted = Sales::whereIn('id', $ids)->delete();

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
