<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartWithProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_title' => $this->product_title,
            'product_image_url' => $this->product_image_url,
            'total_sum' => $this->total_sum,
            'qty' => $this->qty,
            'product_id' => $this->product_id,
            'carts_total_sum' => auth()->user()->refresh()->carts_total_sum,
        ];
    }
}
