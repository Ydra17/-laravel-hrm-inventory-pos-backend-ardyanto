<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    //index
    public function index()
    {
        $warehouses = Warehouse::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Warehouses retrieved successfully',
            'data' => $warehouses
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        //slug
        $warehouse->slug = Str::slug($request->name);
        $warehouse->address = $request->address;
        $warehouse->phone = $request->phone;
        $warehouse->email = $request->email;
        $warehouse->company_id = '1';
        $warehouse->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse created successfully',
            'data' => $warehouse
        ], 201);
    }

    //destroy
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'status' => 'error',
                'message' => 'Warehouse not found'
            ], 404);
        }
        $warehouse->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse deleted successfully'
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'status' => 'error',
                'message' => 'Warehouse not found'
            ], 404);
        }

        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->phone = $request->phone;
        $warehouse->email = $request->email;
        $warehouse->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Warehouse updated successfully',
            'data' => $warehouse
        ], 200);
    }
}
