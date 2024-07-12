<?php

namespace App\Http\Controllers;

use App\Models\PetrolPumb;
use App\Models\ProductType;
use App\Models\PumbProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PumpProductTypeController extends Controller
{

    public function index()
    {
        $selectPumpProduct = ProductType::get();
        $selectPump = PetrolPumb::get();

        $pumpsProducts = DB::table('pumb_product_types')->select('pumb_product_types.*', 'product_types.product_type_name', 'petrol_pumbs.pumb_name')
            ->leftjoin('product_types', 'product_types.id', 'pumb_product_types.product_type_id')
            ->leftjoin('petrol_pumbs', 'petrol_pumbs.id', 'pumb_product_types.pumb_id')
            ->get();

        return view('pump_products.index', compact('selectPumpProduct', 'selectPump'))->with('pumpsProducts', $pumpsProducts);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_type_id' => 'required',
            'pumb_id' => 'required',
        ]);

        $pumpsProducts = new PumbProductType();
        $pumpsProducts->product_type_id = $validatedData['product_type_id'];
        $pumpsProducts->pumb_id = $validatedData['pumb_id'];
        $pumpsProducts->save();

        return redirect()->route('pump_products.index')->with('success', 'Product type successfully created!');
    }



    public function edit($id)
    {
        $pumpsProducts = PumbProductType::findOrFail($id);
        return view('pumpsProducts.edit', compact('pumpsProducts'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'product_type_id' => 'required',
                'pumb_id' => 'required',
            ]);

            $pumpsProducts = new PumbProductType();
            $pumpsProducts->product_type_id = $validatedData['product_type_id'];
            $pumpsProducts->pumb_id = $validatedData['pumb_id'];
            $pumpsProducts->save();

            return redirect()->route('pump_products.index')
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
                $deleted = PumbProductType::whereIn('id', $ids)->delete();

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
