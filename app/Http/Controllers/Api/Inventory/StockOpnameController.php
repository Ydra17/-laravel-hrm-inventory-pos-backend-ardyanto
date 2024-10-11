<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\StockOpname;

class StockOpnameController extends Controller
{
    //ind
    public function index()
    {
        $stockOpnames = StockOpname::with('product', 'warehouse')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Stock opnames retrieved successfully',
            'data' => $stockOpnames
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required|integer',
            'product_id' => 'required|integer',
            'system_stock' => 'required|integer',
            'physical_stock' => 'required|integer',

        ]);

        $stockOpname = new StockOpname();
        $stockOpname->warehouse_id = $request->warehouse_id;
        $stockOpname->product_id = $request->product_id;
        $stockOpname->system_stock = $request->system_stock;
        $stockOpname->physical_stock = $request->physical_stock;
        $stockOpname->deviation = $request->physical_stock - $request->system_stock;
        $stockOpname->note = $request->note;
        $stockOpname->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Stock opname created successfully',
            'data' => $stockOpname
        ], 201);
    }

    //update note
    public function update(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $stockOpname = StockOpname::find($id);
        if (!$stockOpname) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock opname not found'
            ], 404);
        }

        $stockOpname->note = $request->note;
        $stockOpname->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Stock opname note updated successfully',
            'data' => $stockOpname
        ], 200);
    }
}
