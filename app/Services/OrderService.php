<?php

namespace App\Services;

use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderService
{
    protected $orderRepository;
    protected $productRepository;
    protected $orderItemRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        OrderItemRepositoryInterface $orderItemRepository
        )
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
        // Create the order with total_amount as null initially
        $data['total_amount'] = null;
        return $this->orderRepository->create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->orderRepository->update($id, $data);

        // Jika status pesanan diubah menjadi "Completed"
        if ($order->status === 'Completed') {
            $this->handleOrderCompletion($order);
        }

        return $order;
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

    public function calculateAndUpdateTotalAmount($orderId)
    {
        // Find the order
        $order = $this->orderRepository->find($orderId);

        // Calculate the total amount from order items
        $totalAmount = $order->items()->sum('total_price');

        // Update the order's total_amount
        $order->update(['total_amount' => $totalAmount]);

        return $order;
    }

    public function createOrderWithItems(array $orderData)
    {
        // Create the order
        $order = $this->create([
            'supplier_id' => $orderData['supplier_id'],
            'order_date' => $orderData['order_date'],
            'status' => $orderData['status'] ?? 'Pending',
        ]);

        // Add order items
        foreach ($orderData['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Calculate and update the total amount
        $this->calculateAndUpdateTotalAmount($order->id);

        return $order;
    }

    protected function handleOrderCompletion(Order $order)
    {
        // Kurangi stok produk berdasarkan order items
        foreach ($order->items as $item) {
            $product = $item->product;

            // Kurangi stok produk
            $product->quantity -= $item->quantity;

            // Jika stok habis, ubah status menjadi "Out of Stock"
            if ($product->quantity <= 0) {
                $product->quantity = 0;
                $product->status = 'Out of Stock';
            }

            $product->save();
        }

        // Hapus supplier dari order items (artinya supplier sudah membayar)
        $order->items()->update(['payment_status' => 'Paid']);  
    }
}