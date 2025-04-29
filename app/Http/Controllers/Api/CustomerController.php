<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\customerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return new customerResource($customers, "success", "List of Customers");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return new customerResource(null, 'Failed', $validator->errors());
        }

        $customer = Customer::create($request->all());
        return new customerResource($customer, 'Success', 'Customer Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->update($request->all());
            return new customerResource($customer, 'Success', 'Customer Showed Successfully');
        } else {
            return new customerResource(null, 'Failed', 'Customer Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return new customerResource(null, 'Failed', $validator->errors());
        }

        $customer = Customer::find($id);
        if ($customer) {
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return new customerResource($customer, "Success", "Customer Edited Successfully");
        } else {
            return new customerResource(null, "Failed", "Customer Not Found");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return new customerResource(true, "Success", "Customer Deleted Successfully");
        } else {
            return new customerResource(null, "Failed", "Customer Not Found");
        }
    }
}