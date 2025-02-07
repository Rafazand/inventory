<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all(); // Fetch categories for the dropdown
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        
        // Data sudah divalidasi oleh StoreProductRequest
        $validatedData = $request->validated();

        // Upload gambar jika ada
    if ($request->hasFile('image')) {
        $validatedData['image'] = $request->file('image')->store('products', 'public');
    }else {
        $validatedData['image'] = null;
    }

        // Delegate the creation logic to the service
        $this->productService->create($validatedData);

        // Redirect with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $categories = \App\Models\Category::all(); // Fetch categories for the dropdown
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        // Validate the request
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|numeric|min:0',
        //     'quantity' => 'required|integer|min:0',
        //     'category_id' => 'required|exists:categories,id',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // Data sudah divalidasi oleh StoreProductRequest
        $validatedData = $request->validated();

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        } else {
            $validatedData['image'] = null;
        }

        // Jika description kosong, set menjadi null
        $validatedData['description'] = $request->input('description') ?: null;

        // Delegate the update logic to the service
        $this->productService->update($id, $validatedData);

        // Redirect with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $this->productService->delete($id);

        // Redirect with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}