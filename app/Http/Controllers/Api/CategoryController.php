<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
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
        try {
            $category = $this->categoryService->update($id, $request->all());
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->json(null, 204);
    }
}