<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Services\SupplierValidationService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $supplierValidationService;

    public function __construct(OrderService $orderService, SupplierValidationService $supplierValidationService)
    {
        $this->orderService = $orderService;
        $this->supplierValidationService = $supplierValidationService;
    }

    // 🟢 GET: Ambil semua order
    public function index()
    {
        $orders = $this->orderService->all();
        return response()->json([
            'success' => true,
            'data' => $orders,
        ], 200);
    }

    // 🟢 POST: Simpan order baru
    public function store(OrderRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $supplierId = $request->input('supplier_id');

            // Validasi apakah supplier bisa membuat order baru
            if (!$this->supplierValidationService->canCreateOrder($supplierId)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier has a pending order. Please complete the current order before creating a new one.'
                ], 400);
            }

            // Simpan order baru
            $order = $this->orderService->create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully.',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 🟢 GET: Ambil satu order berdasarkan ID
    public function show($id)
    {
        $order = $this->orderService->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    // 🟢 PUT/PATCH: Update order
    public function update(OrderRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $order = $this->orderService->update($id, $validatedData);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully.',
                'data' => $order
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 🟢 DELETE: Hapus order
    public function destroy($id)
    {
        try {
            $deleted = $this->orderService->delete($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found or already deleted.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
