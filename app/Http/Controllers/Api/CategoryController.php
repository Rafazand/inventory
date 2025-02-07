<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
        return response()->json($category, 200);
    }

    public function edit($id)
    {
        $categories = $this->categoryService->find($id);
        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request->all());
            return response()->json($category, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        // try {
        //     $category = $this->categoryService->update($id, $request->all());
        //     return response()->json($category);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 400);
        // }

        // try {
        //     // Gunakan $request->validated() untuk mengambil data yang sudah divalidasi
        //     $validatedData = $request->validated();
    
        //     // Update kategori menggunakan service layer
        //     $category = $this->categoryService->update($id, $validatedData);
    
        //     // Return response sukses
        //     return response()->json([
        //         'success' => true,
        //         'data' => $category,
        //         'message' => 'Category updated successfully.',
        //     ], 200);
    
        // } catch (\Exception $e) {
    
        //     // Return response error yang aman
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to update category. Please try again.',
        //     ], 400);
        // }

        try {
            $validatedData = $request->validated();
    
            // Hanya update field yang diubah
            $updateData = [];
            if ($request->has('name')) {
                $updateData['name'] = $validatedData['name'];
            }
            if ($request->has('description')) {
                $updateData['description'] = $validatedData['description'];
            }
    
            $category = $this->categoryService->update($id, $updateData);
    
            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Category updated successfully.',
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category. Please try again.',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->json(null, 204);
    }
}