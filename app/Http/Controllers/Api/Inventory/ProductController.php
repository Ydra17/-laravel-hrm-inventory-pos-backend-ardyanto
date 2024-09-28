<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'unit_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',

            'warehouse_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'item_code' => 'required|string',
            'alert_stock' => 'nullable|integer',
            'status' => 'nullable|integer',

        ]);

        $product = new Product();
        $product->name = $request->name;
        //slug
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->unit_id = $request->unit_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;

        $product->warehouse_id = $request->warehouse_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->alert_stock = $request->alert_stock;
        //status
        $product->status = $request->status;
        $product->item_code = $request->item_code;
        $product->company_id = '1';

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $filePath = $photo->storeAs('images/products', $photo_name, 'public');
            $product->photo = $filePath;
        }

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    //destroy
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'unit_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',

            'warehouse_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'item_code' => 'required|string',
            'alert_stock' => 'nullable|integer',
            'status' => 'nullable|integer',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_id = $request->unit_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;

        $product->warehouse_id = $request->warehouse_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->alert_stock = $request->alert_stock;
        //status
        $product->status = $request->status;
        $product->item_code = $request->item_code;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $filePath = $photo->storeAs('images/products', $photo_name, 'public');
            $product->photo = $filePath;
        }

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        $product->load('category', 'brand', 'unit', 'warehouse');

        return response()->json([
            'status' => 'success',
            'message' => 'Product retrieced successfully',
            'data' => $product
        ], 200);
    }
}
