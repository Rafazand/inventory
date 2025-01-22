<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    protected $model;

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['order', 'product'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['order', 'product'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $orderItem = $this->model->findOrFail($id);
        $orderItem->update($data);
        return $orderItem;
    }

    public function delete($id)
    {
        $orderItem = $this->model->findOrFail($id);
        $orderItem->delete();
        return $orderItem;
    }

    public function removeSupplier($id)
    {
        $orderItem = $this->model->findOrFail($id);
        $orderItem->update([
            'supplier_id' => null,
        ]);
        return $orderItem;
    }
}