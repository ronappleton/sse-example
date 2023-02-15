<?php

declare(strict_types=1);

namespace RonAppleton\SseExample\Http\Controllers;

use RonAppleton\SseExample\Helpers\View;
use RonAppleton\SseExample\Models\Order;

class OrderController extends BaseController
{
    public function index(): false|string
    {
        $orders = Order::all();

        return View::render('orders.index', ['orders' => $orders->toArray()]);
    }

    public function edit(int $order): false|string
    {
        $order = Order::find($order);

        return View::render('orders.edit', ['order' => $order->toArray()]);
    }
}