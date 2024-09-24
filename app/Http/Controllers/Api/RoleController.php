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
        //validate request
        // list permission
        //
        //
        $request->validate([
            'name' => 'required',

        ]);

        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        return response([
            'message' => 'Role updated',
            'data' => $role
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
