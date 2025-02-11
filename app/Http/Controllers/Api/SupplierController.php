<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SupplierRequest;
use App\Services\SupplierService;
use App\Http\Requests;
use App\Models\Supplier;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->all();
        return response()->json([
            'success' => true,
            'data' => $suppliers
        ]);
    }

    public function show($id)
    {
        $supplier = $this->supplierService->find($id);
        return response()->json($supplier, 200);
    }

    public function create()
    {
        // Biasanya, method create tidak diperlukan dalam API karena form dibuat di frontend
        return response()->json([
            'success' => false,
            'message' => 'Method not allowed for API'
        ], 405); // 405 Method Not Allowed
    }

    public function store(SupplierRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Delegate the creation logic to the service
        $supplier = $this->supplierService->create($validatedData);

        // Return JSON response
        return response()->json([
            'success' => true,
            'data' => $supplier,
            'message' => 'Supplier created successfully.'
        ], 201); // 201 Created
    }

    public function edit($id)
    {
        // Biasanya, method edit tidak diperlukan dalam API karena form dibuat di frontend
        return response()->json([
            'success' => false,
            'message' => 'Method not allowed for API'
        ], 405); // 405 Method Not Allowed
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            // Validate the request
            $validatedData = $request->validated();

            // Delegate the update logic to the service
            $supplier = $this->supplierService->update($id, $validatedData);

            // Return JSON response
            return response()->json([
                'success' => true,
                'data' => $supplier,
                'message' => 'Supplier updated successfully.'
            ]);
        } catch (\Exception $e) {
            // Return JSON response with error message
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400); // 400 Bad Request
        }
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $this->supplierService->delete($id);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully.'
        ]);
    }
}