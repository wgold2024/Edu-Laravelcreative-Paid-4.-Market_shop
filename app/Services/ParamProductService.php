<?php

namespace App\Services;

use App\Models\Param;
use App\Models\ParamProduct;
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

    public static function getGroupedByParamArray(Product $product): array
    {
        $paramProduct = ParamProduct::groupedByParams($product)->get()
        ->groupBy('param_id')->map(function ($paramProductitem){
            return [
                'title' => $paramProductitem->first()->title,
                'data' => $paramProductitem->toArray()
            ];
        });

        return array_values($paramProduct->toArray());
    }
}
