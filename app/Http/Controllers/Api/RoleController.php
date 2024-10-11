<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //index
    public function index()
    {
        $roles = Role::all();
        return response([
            'message' => 'Role List',
            'data' => $roles
        ], 200);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = new Role();
        $role->company_id = 1;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        return response([
            'message' => 'Role created',
            'data' => $role
        ], 201);
    }

    //show
    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        return response([
            'message' => 'Role details',
            'data' => $role
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        // Temukan Role berdasarkan ID
        $role = Role::findOrFail($id);

        // Melakukan validasi data yang dikirim dalam request
        $validated = $request->validate([
            'role_name' => 'sometimes|required|string|max:255|unique:roles,role_name,' . $id, // role_name harus unik tapi bisa diabaikan jika tidak diubah
            'display_name' => 'sometimes|required|string|max:255', // display_name bisa diubah, wajib jika disertakan
            'description' => 'sometimes|nullable|string', // description bisa diubah, opsional
            'permissions' => 'nullable|array', // permissions opsional, harus berupa array
            'permissions.*' => 'exists:permissions,id', // Setiap elemen dalam array permissions harus ada dalam tabel permissions
        ]);

        // Update data Role dengan data yang divalidasi
        $role->update($validated);

        // Jika permissions disertakan, update permissions untuk Role ini
        if (isset($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        // Ambil kembali Role yang sudah diupdate beserta relasi permissions-nya
        $role = Role::with('permissions')->findOrFail($id);


        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role,
        ], 200);
    }

    //delete
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        $role->delete();
        return response([
            'message' => 'Role deleted'
        ], 200);
    }
}
