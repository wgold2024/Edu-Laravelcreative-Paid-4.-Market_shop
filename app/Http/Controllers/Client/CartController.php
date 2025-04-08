<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index() {
        return inertia('Client/Cart/Index');
    }
}
