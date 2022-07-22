<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Collection;

class OrderService
{
    public function create($order_number, $account_name, $account_number, $order_date): Order
    {
        $order = Order::create(
            [
                'account_name' => $account_name,
                'account_number' => $account_number,
                'order_number' => $order_number,
                'order_date' => $order_date,
                'status' => OrderStatus::DRAFT
            ]
        );
        return $order;
    }
/* 
    public function create(StoreOrderRequest $request): Order
    {
        $order = new Order(
            [
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'order_number' => $request->order_number,
                'order_date' => $request->order_date,
                'status' => OrderStatus::DRAFT
            ]
        );

        
        if ($order->save()){
            $ordered_products = [];
            foreach ($request->products as $product) {
                $ordered_products[] = [
                    'name' => $product['name'],
                    'sku' => $product['sku'], 
                    'amount' => $product['amount'], 
                    'quantity' => $product['quantity'],
                    'order_id' => $order->id,
                ];
            }
    
            $order->ordered_products()->createMany($ordered_products);
        }

        return $order;
    } */
}
