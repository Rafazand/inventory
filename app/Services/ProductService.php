<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}