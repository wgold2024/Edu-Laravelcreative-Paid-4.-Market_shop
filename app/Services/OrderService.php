<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrderService
{
    public static function store() : Order
    {
        $order = auth()->user()->orders()->create();

        auth()->user()->carts()->update(['order_id' => $order->id]);

        return $order;
    }
}
