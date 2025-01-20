<?php

namespace App\Services;

use App\Repositories\SupplierRepositoryInterface;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function all()
    {
        return $this->supplierRepository->all();
    }

    public function find($id)
    {
        return $this->supplierRepository->find($id);
    }

    public function create(array $data)
    {
        // Check if email already exists
        if ($this->supplierRepository->findByEmail($data['email'])) {
            throw new \Exception('Email already exists.');
        }

        // Delegate to repository
        return $this->supplierRepository->create($data);
    }

    public function update($id, array $data)
    {
        // Check if another supplier with the same email already exists
        $existingSupplier = $this->supplierRepository->findByEmail($data['email']);
        if ($existingSupplier && $existingSupplier->id != $id) {
            throw new \Exception('Email already exists.');
        }

        // Delegate to repository
        return $this->supplierRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->supplierRepository->delete($id);
    }
}