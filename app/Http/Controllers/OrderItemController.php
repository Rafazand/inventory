<?php

namespace App\Http\Controllers;

use App\Services\OrderItemService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderItemController extends Controller
{
    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        $orderItems = $this->orderItemService->all();
        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = \App\Models\Order::all(); // Fetch orders for the dropdown
        $products = \App\Models\Product::all(); // Fetch products for the dropdown
        return view('order_items.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0|max:99999999.99',
            'total_price' => 'nullable|numeric|min:0|max:99999999.99',
        ]);

        // Delegate the creation logic to the service
        $this->orderItemService->create($validatedData);

        // Redirect with a success message
        return redirect()->route('order_items.index')
                         ->with('success', 'Order item created successfully.');
    }

    public function edit($id)
    {
        $orderItem = $this->orderItemService->find($id);
        $orders = \App\Models\Order::all(); // Fetch orders for the dropdown
        $products = \App\Models\Product::all(); // Fetch products for the dropdown
        return view('order_items.edit', compact('orderItem', 'orders', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0|max:99999999.99',
            'total_price' => 'nullable|numeric|min:0|max:99999999.99',
        ]);

        // Delegate the update logic to the service
        $this->orderItemService->update($id, $validatedData);

        // Redirect with a success message
        return redirect()->route('order_items.index')
                         ->with('success', 'Order item updated successfully.');
                         
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $this->orderItemService->delete($id);

        // Redirect with a success message
        return redirect()->route('order_items.index')
                         ->with('success', 'Order item deleted successfully.');
    }
}