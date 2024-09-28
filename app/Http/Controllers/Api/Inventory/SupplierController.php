<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //index
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Suppliers retrieved successfully',
            'data' => $suppliers
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

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->slug = Str::slug($request->name);
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Supplier created successfully',
            'data' => $supplier
        ], 201);
    }

    //destroy
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found'
            ], 404);
        }
        $supplier->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Supplier deleted successfully'
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

        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found'
            ], 404);
        }

        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Supplier updated successfully',
            'data' => $supplier
        ], 200);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Suuplier retrieced successfully',
            'data' => $supplier
        ], 200);
    }
}
