<?php

namespace App\Interfaces;

interface SupplierValidationInterface
{
    public function canCreateOrder($supplierId);
}