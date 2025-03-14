<?php

namespace App\Services;

use App\Repositories\OrderItemRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class OrderItemService
{
    protected $productRepository;
    protected $orderItemRepository;
    protected $orderRepository;
    

    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository, 
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository
        )
    {
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
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
        // Fetch the product price from the product repository
        $product = $this->productRepository->find($data['product_id']);

        // Validate that the order item quantity does not exceed the available product quantity
        if ($data['quantity'] > $product->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'The quantity cannot exceed the available stock (' . $product->quantity . ').',
            ]);
        }

        // Check if the product is out of stock
        if ($product->status === 'Out of Stock') {
            throw ValidationException::withMessages([
                'product_id' => 'This product is out of stock and cannot be ordered.',
            ]);
        }
        

        // Set unit_price and calculate total_price
        $data['unit_price'] = $product->price; // Set unit_price from product price
        $data['total_price'] = $data['quantity'] * $product->price; // Calculate total_price

        // Create the order item
        $orderItem = $this->orderItemRepository->create($data);

        // Recalculate and update the total_amount for the order
        $this->updateOrderTotalAmount($orderItem->order_id);

        return $orderItem;
    }

    public function update($id, array $data)   
    {

        DB::beginTransaction(); // Mulai transaction

    try {
        // Fetch the existing order item
        $orderItem = $this->orderItemRepository->find($id);

        // Fetch the product price from the product repository
        $product = $this->productRepository->find($data['product_id']);

        // Validate that the updated order item quantity does not exceed the available product quantity
        if ($data['quantity'] > $product->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'The quantity cannot exceed the available stock (' . $product->quantity . ').',
            ]);
        }

        // Set unit_price and calculate total_price
        $data['unit_price'] = $product->price; // Set unit_price from product price
        $data['total_price'] = $data['quantity'] * $product->price; // Calculate total_price

        // Jika order_id diubah, kurangi total_amount dari order lama
        if ($orderItem->order_id != $data['order_id']) {
            $this->updateOrderTotalAmount($orderItem->order_id); // Update order lama
        }

        // Update the order item
        $orderItem = $this->orderItemRepository->update($id, $data);

        // Recalculate and update the total_amount for the order
        $this->updateOrderTotalAmount($orderItem->order_id);

        DB::commit();

        return $orderItem;
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback transaction jika terjadi error
        throw $e;
    }
    }

    public function delete($id)
    {
        return $this->orderItemRepository->delete($id);
    }

    protected function updateOrderTotalAmount($orderId)
    {
        // Find the order
        $order = $this->orderRepository->find($orderId);

        // Calculate the total amount from order items
        $totalAmount = $order->items()->sum('total_price');

        // Update the order's total_amount
        $order->update(['total_amount' => $totalAmount]);
    }
}