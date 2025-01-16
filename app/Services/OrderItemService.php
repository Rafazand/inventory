<?php

namespace App\Services;

use App\Repositories\OrderItemRepositoryInterface;

class OrderItemService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function all()
    {
        return $this->orderItemRepository->all();
    }

    public function find($id)
    {
        return $this->orderItemRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->orderItemRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->orderItemRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->orderItemRepository->delete($id);
    }
}