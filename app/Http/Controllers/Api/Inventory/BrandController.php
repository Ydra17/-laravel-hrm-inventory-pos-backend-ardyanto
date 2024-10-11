<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Brands retrieved successfully',
            'data' => $brands
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        // $brand->description = $request->description;
        //image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $file_path = $image->storeAs('images/brands', $image_name, 'public');
            $brand->image = $file_path;
        }
        $brand->company_id = '1';
        $brand->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Brand created successfully',
            'data' => $brand
        ], 201);
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'status' => 'error',
                'message' => 'Brand not found'
            ], 404);
        }

        $brand->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Brand deleted successfully'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'status' => 'error',
                'message' => 'Brand not found',
            ], 404 );
        }


        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $file_path = $image->storeAs('images/brands', $image_name, 'public');
            $brand->image = $file_path;
        }
        $brand->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Brand updated successfully',
            'data' => $brand
        ], 200);
    }
}
