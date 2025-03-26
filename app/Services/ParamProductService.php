<?php

namespace App\Services;

use App\Models\Param;
use App\Models\Product;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class ParamProductService
{
    public static function replicateBatch(Product $product, Product $cloneProduct)
    {
        foreach ($product->paramProducts as $paramProduct) {
            $cloneParamProduct = $paramProduct->replicate();
            $cloneParamProduct->product_id = $cloneProduct->id;
            $cloneParamProduct->push();
        }
    }
}
