<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function create(array $data)
    {
        // Check if category with the same name already exists
        if ($this->categoryRepository->findByName($data['name'])) {
            throw new \Exception('Category name already exists.');
        }
    
        return $this->categoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}