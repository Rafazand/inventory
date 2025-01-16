<?php

namespace App\Services;

class MenuService implements MenuServiceInterface
{
    public function getMenuItems(): array
    {
        return [
            [
                'name' => 'Products',
                'route' => 'products.index',
                'description' => 'Manage all products in the inventory.',
                'icon' => 'fa-box',
            ],
            [
                'name' => 'Categories',
                'route' => 'categories.index',
                'description' => 'Manage product categories.',
                'icon' => 'fa-tags',
            ],
            [
                'name' => 'Suppliers',
                'route' => 'suppliers.index',
                'description' => 'Manage suppliers who provide products.',
                'icon' => 'fa-truck',
            ],
            [
                'name' => 'Orders',
                'route' => 'orders.index',
                'description' => 'Manage orders placed for products.',
                'icon' => 'fa-shopping-cart',
            ],
            [
                'name' => 'Order Items',
                'route' => 'order_items.index',
                'description' => 'Manage items included in orders.',
                'icon' => 'fa-list',
            ],
        ];
    }
}