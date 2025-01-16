<?php

namespace App\Http\Controllers;

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
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = \App\Models\Supplier::all(); // Fetch suppliers for the dropdown
        return view('orders.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'items' => 'required|array',
        //     'items.*.product_id' => 'required|exists:products,id',
        //     'items.*.quantity' => 'required|integer|min:1',
        // ]);

        // try {
        //     $order = $this->orderService->createOrder($request->all());
        //     return response()->json($order, 201);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 400);
        // }

        // Validate the request
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0|max:99999999.99',
            'status' => 'required|string|in:Pending,Completed,Cancelled',
        ]);

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

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:Pending,Completed,Cancelled',
        ]);

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