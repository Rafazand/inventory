<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->all();
        return view('categories.index', compact('categories')); 
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('categories.create');
    }

    public function edit($id)
    {
        $categories = $this->categoryService->find($id);
        return view('categories.edit', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();
        $categories = $this->categoryService->all();
    
        try {
            $this->categoryService->create($request->all());
            return redirect()->route('categories.index')
                             ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()])->withInput();
        }
    }
    public function update(CategoryRequest $request, $id)
    {

        try {
            // Gunakan $request->validated() untuk mengambil data yang sudah divalidasi
            $validatedData = $request->validated();
    
            // Update kategori menggunakan service layer
            $category = $this->categoryService->update($id, $validatedData);
    
            // Return response sukses
            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Category updated successfully.',
            ], 200);
    
        } catch (\Exception $e) {
    
            // Return response error yang aman
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category. Please try again.',
            ], 400);
        }
    }


    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}