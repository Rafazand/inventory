<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Http\Requests\OrderRequest;
use App\Services\OrderItemService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\OrderItem;

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
        $orderItems = OrderItem::with('order.supplier')->get();
        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = \App\Models\Order::all(); // Fetch orders for the dropdown
        $products = \App\Models\Product::all(); // Fetch products for the dropdown
        return view('order_items.create', compact('orders', 'products'));
    }

    public function store(OrderItemRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();

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

    public function update(OrderItemRequest $request, $id)
    {
        // Validate the request
        $validatedData = $request->validated();

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