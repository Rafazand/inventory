<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index()
    {
        $orders = $this->orderService->all();
        return view('orders.index', compact('orders',));
    }

    public function create()
    {
        $suppliers = \App\Models\Supplier::all(); // Fetch suppliers for the dropdown
        $products = \App\Models\Product::all(); // Fetch products for the dropdown
        return view('orders.create', compact('suppliers', 'products'));
    }

    public function store(OrderRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Delegate the creation logic to the service
        $this->orderService->create($validatedData);

        // Redirect with a success message
        return redirect()->route('orders.index')
                         ->with('success', 'Order created successfully.');
    }

    public function edit($id)
    {
        $order = $this->orderService->find($id);
        $suppliers = \App\Models\Supplier::all(); // Fetch suppliers for the dropdown
        return view('orders.edit', compact('order', 'suppliers'));
    }

    public function update(OrderRequest $request, $id)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Delegate the update logic to the service
        $this->orderService->update($id, $validatedData);

        // Redirect with a success message
        return redirect()->route('orders.index')
                         ->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $this->orderService->delete($id);

        // Redirect with a success message
        return redirect()->route('orders.index')
                         ->with('success', 'Order deleted successfully.');
    }
}