<?php

namespace App\Services;

use App\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function find($id)
    {
        return $this->orderRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->orderRepository->delete($id);
    }

    public function createOrder(array $orderData)
    {
        $order = Order::create([
            'order_date' => now(),
            'total_amount' => 0, // Initialize total amount
        ]);

        $totalAmount = 0;

        foreach ($orderData['items'] as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                throw new \Exception("Product not found: {$item['product_id']}");
            }

            $unitPrice = $product->price;
            $totalPrice = $unitPrice * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
            ]);

            $totalAmount += $totalPrice;
        }

        // Update the total amount of the order
        $order->update(['total_amount' => $totalAmount]);

        return $order;
    }
}