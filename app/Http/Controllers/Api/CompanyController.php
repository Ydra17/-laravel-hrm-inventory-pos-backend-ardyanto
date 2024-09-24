<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function editCompany(Request $request)
    {
        $company = Company::where('id', 1)->first();

        if ($request->has('name')) {
            $company->name = $request->name;
        }

        if ($request->has('email')) {
            $company->email = $request->email;
        }

        // if ($request->has('logo')) {
        //     $request->validate([
        //         'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        //     ]);
        //     $imageName = time() . '.' . $request->logo->extension();
        //     $request->logo->move(public_path('images'), $imageName);
        //     $company->logo = $imageName;
        // }

        if ($request->has('website')) {
            $company->website = $request->website;
        }

        if ($request->has('phone')) {
            $company->phone = $request->phone;
        }

        if ($request->has('address')) {
            $company->address = $request->address;
        }

        if ($request->has('status')) {
            $company->status = $request->status;
        }

        if ($request->has('total_users')) {
            $company->total_users = $request->total_users;
        }

        if ($request->has('clock_in_time')) {
            $company->clock_in_time = $request->clock_in_time;
        }

        if ($request->has('clock_out_time')) {
            $company->clock_out_time = $request->clock_out_time;
        }

        if ($request->has('early_clock_in_time')) {
            $company->early_clock_in_time = $request->early_clock_in_time;
        }

        if ($request->has('allow_clock_out_till')) {
            $company->allow_clock_out_till = $request->allow_clock_out_till;
        }

        if ($request->has('self_clocking')) {
            $company->self_clocking = $request->self_clocking;
        }

        $company->save();

        return response([
            'message' => 'Company updated successfully',
            'company' => $company
        ], 200);
    }

    public function showCompany()
    {
        $company = Company::where('id', 1)->first();
        return response([
            'message' => 'Company Details',
            'company' =>$company
        ], 200);
    }
}
