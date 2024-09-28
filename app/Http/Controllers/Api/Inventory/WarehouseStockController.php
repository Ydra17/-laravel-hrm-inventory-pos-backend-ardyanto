<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;

class WarehouseStockController extends Controller
{
    public function index()
    {
        $data = WarehouseStock::with('product', 'warehouse')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse stock retrieved successfully',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required|integer',
            'product_id' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $warehouse = Warehouse::find($request->warehouse_id);
        if (!$warehouse) {
            return response()->json([
                'status' => 'error',
                'message' => 'Warehouse not Found',
            ], 404);
        }

        $warehouseStock = $warehouse->products()->where('id', $request->product_id)->first();
        if ($warehouseStock) {
            $warehouseStock->stock = $request->stock;
            $warehouseStock->save();

            $stock = new WarehouseStock();
            $stock->warehouse_id = $request->warehouse_id;
            $stock->product_id = $request->product_id;
            $stock->stock = $request->stock;
            $stock->date_stock = $request->stock;

            $stock->date_stock = now();
            $stock->save();
        } else {
            $warehouse->products()->attach($request->product_id, [
                'stock' => $request->stock
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse stock updated successfully',
            'data' => $warehouse
        ], 200);
    }
}
