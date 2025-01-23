<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('supplier')->get();
    }

    public function find($id)
    {
        return $this->model->with('supplier')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->model->findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = $this->model->findOrFail($id);
        $order->delete();
        return $order;
    }

    public function findPendingOrderBySupplier($supplierId)
    {
    return $this->model->where('supplier_id', $supplierId)
                       ->where('status', 'Pending')
                       ->first();
    }
}