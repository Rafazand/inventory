<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\Product;
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
        return response()->json($products, 200);
    }

    public function show($id)
{
    $product = Product::with('category')->find($id); // Ambil produk beserta kategori
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }
    return response()->json($product);

}

    public function create()
    {
        $categories = \App\Models\Category::all(); // Fetch categories for the dropdown
        return response()->json($categories, 200);
    }

    public function store(ProductRequest $request)
    {
        
        // Data sudah divalidasi oleh StoreProductRequest
        $validatedData = $request->validated();

        // Upload gambar jika ada
    if ($request->hasFile('image')) {
        $validatedData['image'] = $request->file('image')->store('products', 'public');
    }

        // Delegate the creation logic to the service
        $product= $this->productService->create($validatedData);

        // Redirect with a success message
        return response()->json(['success' => true, 'message' => 'Product created successfully.', 'data' => $product], 201);
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $categories = \App\Models\Category::all(); // Fetch categories for the dropdown
        return response()->json($product, $categories);
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
        }

        // Delegate the update logic to the service
        $this->productService->update($id, $validatedData);

        // Redirect with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        // Delegate the deletion logic to the service
        $product= $this->productService->delete($id);

        // Redirect with a success message
        return response()->json(['success' => true, 'message' => 'Product created successfully.', 'data' => $product], 201);
    }
}

