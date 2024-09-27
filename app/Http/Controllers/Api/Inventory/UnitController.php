<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UnitController extends Controller
{
    //index
    public function index()
    {
        $units = Unit::all();
        return response()->json([
            'status' => 'success',
            'message' => 'units retrieved successfully',
            'data' => $units
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'short_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->slug = Str::slug($request->name);
        $unit->description = $request->description;
        $unit->short_name = $request->short_name;
        $unit->company_id = '1';
        $unit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Unit created successfully',
            'data' => $unit
        ], 201);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit not found'
            ], 404);
        }
        $unit->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Unit deleted successfully'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'short_name' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $unit = Unit::find($id);
        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit not Found'
            ], 404);
        }

        $unit->name = $request->name;
        $unit->slug = Str::slug($request->name);
        $unit->description = $request->description;
        $unit->short_name = $request->short_name;
        $unit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Unit updated successfully',
            'data' => $unit,
        ], 200);
    }
}
