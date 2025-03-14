<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->model->findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->findOrFail($id);
        $category->delete();
        return $category;
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}