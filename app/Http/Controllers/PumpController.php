<?php

namespace App\Http\Controllers;

use App\Models\PetrolPumb;
use Illuminate\Http\Request;

class PumpController extends Controller
{

    public function index()
    {
        $pumps = PetrolPumb::all();
        return view('pump.index')->with('pumps', $pumps);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'pumb_name' => 'required|string|max:255',
        ]);

        $pumps = new PetrolPumb();
        $pumps->pumb_name = $validatedData['pumb_name'];
        $pumps->save();
        return redirect()->route('pump.index')
            ->with('success', 'Product type successfully created!');
    }

    public function edit($id)
    {
        $pumps = PetrolPumb::findOrFail($id);
        return view('pump.edit', compact('pumps'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'pumb_name' => 'required|string|max:255',
            ]);

            $pumps = PetrolPumb::findOrFail($id);

            $pumps->pumb_name = $validatedData['pumb_name'];
            $pumps->save();

            return redirect()->route('pump.index')
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
                $deleted = PetrolPumb::whereIn('id', $ids)->delete();

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
