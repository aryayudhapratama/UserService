<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);
    
        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
        

        return redirect()->route('customers.index')->with('success', 'Customer berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);

        $orders = Http::get('http://127.0.0.1:8002/api/orders-api')->json()['data'];
        $products = Http::get('http://127.0.0.1:8001/api/products-api')->json()['data'];

        $orders = collect($orders);
        $products = collect($products);

        $customerOrders = $orders->where('customer_id', $id)->values();

        $customerOrders = $customerOrders->map(function ($order) use ($products) {
            $order['product'] = $products->firstWhere('id', $order['product_id']);
            return $order;
        });

        return view('customers.history', compact('customer', 'customerOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
