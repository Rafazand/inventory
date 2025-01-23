<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\SupplierService;
use Illuminate\Http\Request;

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
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(SupplierRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Delegate the creation logic to the service
        $this->supplierService->create($validatedData);

        // Redirect with a success message
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
                // Validate the request
                $validatedData = $request->validated();

                // Delegate the update logic to the service
                $this->supplierService->update($id, $validatedData);

                // Redirect with a success message
                return redirect()->route('suppliers.index')
                                ->with('success', 'Supplier updated successfully.');
            }catch (\Exception $e) {
                // Redirect back with error message
                return redirect()->back()
                            ->withInput()
                            ->withErrors(['email' => $e->getMessage()]);
                }
                    
                    
                
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $this->supplierService->delete($id);

        // Redirect with a success message
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier deleted successfully.');
    }
}