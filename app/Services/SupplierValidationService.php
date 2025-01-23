<?php

namespace App\Services;

use App\Interfaces\SupplierValidationInterface;
use App\Repositories\OrderRepositoryInterface;

class SupplierValidationService implements SupplierValidationInterface
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function canCreateOrder($supplierId)
    {
        // Cek apakah supplier memiliki order dengan status "Pending"
        $pendingOrder = $this->orderRepository->findPendingOrderBySupplier($supplierId);

        if ($pendingOrder) {
            return false; // Supplier tidak bisa membuat order baru
        }

        return true; // Supplier bisa membuat order baru
    }
}