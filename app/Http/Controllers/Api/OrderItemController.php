<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderItemRequest;
use App\Services\OrderItemService;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;

class OrderItemController extends Controller
{
    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    // ✅ Get all order items
    public function index()
    {
        $orderItems = OrderItem::with(['order.supplier', 'product'])->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $orderItems
        ], 200);
    }

    // ✅ Create a new order item
    public function store(OrderItemRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $orderItem = $this->orderItemService->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Order item created successfully.',
                'data' => $orderItem
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create order item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ Get a single order item by ID
    public function show($id)
    {
        try {
            $orderItem = OrderItem::with(['order.supplier', 'product'])->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $orderItem
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order item not found.'
            ], 404);
        }
    }

    // ✅ Update an order item
    public function update(OrderItemRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $orderItem = $this->orderItemService->update($id, $validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Order item updated successfully.',
                'data' => $orderItem
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order item not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update order item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ✅ Delete an order item
    public function destroy($id)
    {
        try {
            $this->orderItemService->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Order item deleted successfully.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order item not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete order item.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
