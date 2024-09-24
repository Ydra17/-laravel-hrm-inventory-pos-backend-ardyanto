<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    //index
    public function index()
    {
        $users = User::with('department', 'designation', 'shift', 'role')->get();
        return response([
            'message' => 'Staffs list',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'username' => 'required|unique:users,username',
            // 'company_id' => 'required',
            // 'is_superadmin' => 'required',
            'role_id' => 'required',
            // 'user_type' => 'required',
            // 'login_enabled' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'shift_id' => 'required'
        ]);

        $user = new User();
        $user->company_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->is_superadmin = $request->is_superadmin;
        $user->role_id = $request->role_id;
        $user->user_type = $request->user_type;
        $user->login_enabled = $request->login_enabled;
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->department_id = $request->department_id;
        $user->designation_id = $request->designation_id;
        $user->shift_id = $request->shift_id;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('images/staff', $fileName, 'public');
            $user->profile_image = '/storage/' . $filePath;
        }

        $user->save();

        return response([
            'message' => 'Staff created',
            'data' => $user,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'role_id' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'shift_id' => 'required',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'Staff not found',
            ], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->department_id = $request->department_id;
        $user->designation_id = $request->designation_id;
        $user->shift_id = $request->shift_id;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images/staff', $fileName, 'public');
            $user->profile_image= '/storage/' . $filePath;
        }

        $user->save();

        return response([
            'message' => 'Staff updated',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = user::find($id);
        if (!$user) {
            return response([
                'message' => 'Staff not found',
            ], 404);
        }

        $user->delete();

        return response([
            'message' => 'Staff deleted',
        ], 200);
    }
}
