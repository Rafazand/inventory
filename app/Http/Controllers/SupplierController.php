<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email',
            'phone' => 'required|string|max:20|digits_between:10,15',
            'address' => 'required|string',
        ]);

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

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string',
        ]);

        // Delegate the update logic to the service
        $this->supplierService->update($id, $validatedData);

        // Redirect with a success message
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier updated successfully.');
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