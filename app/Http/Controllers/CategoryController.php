<?php

namespace App\Http\Controllers;

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
        $validatedData = $request->validated();
        $categories = $this->categoryService->all();    
        try {
            $this->categoryService->update($id, $request->all());
            return redirect()->route('categories.index')
                             ->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()])->withInput();
        }
    }


    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}