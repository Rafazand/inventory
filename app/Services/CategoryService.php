<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

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
        // Check if another category with the same name already exists
        $existingCategory = $this->categoryRepository->findByName($data['name']);
        if ($existingCategory && $existingCategory->id != $id) {
            throw new \Exception('Category name already exists.');
        }
    
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}