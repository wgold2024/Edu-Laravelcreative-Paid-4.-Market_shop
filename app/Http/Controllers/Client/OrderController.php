<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Order\StoreRequest;
use App\Http\Resources\Order\OrderWithCartResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(StoreRequest $request)
    {
        $order = OrderService::store();

        return redirect()->route('client.orders.transactions.create', $order->id);
    }

    public function createTransaction(Order $order)  {
        $order = OrderWithCartResource::make($order)->resolve();

        return inertia('Client/Order/CreateTransaction', compact('order'));
    }

}
