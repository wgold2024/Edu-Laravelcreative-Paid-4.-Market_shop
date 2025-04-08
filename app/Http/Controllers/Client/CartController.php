<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\StoreRequest;
use App\Http\Resources\Cart\CartResource;
use App\Services\CartService;


class CartController extends Controller
{
    public function index() {
        return inertia('Client/Cart/Index');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $cart = CartService::store($data);

        return CartResource::make($cart)->resolve();
    }
}
