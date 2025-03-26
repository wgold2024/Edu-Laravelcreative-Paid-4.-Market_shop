<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public static function store(array $data) : Product
    {
        try {
            DB::beginTransaction();

            $product = Product::create($data['product']);
            ProductService::attachBatchParams($product, $data);
            ImageService::storeBatch($product, $data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, "Store transaction failed");
        }

        return $product;
    }


    public static function indexByCategories(Collection $categoryChildren, array $data) : Collection
    {
        $products = Product::byCategories($categoryChildren)->filter($data);

        return $products->distinct('parent_id')->get();
    }

    public static function update(array $data, Product $product) : Product
    {
        try {
            DB::beginTransaction();

            $product->update($data['product']);
            ProductService::syncBatchParams($product, $data);
            ImageService::storeBatch($product, $data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, "Update transaction failed");
        }

        return $product->fresh();
    }

    public static function attachBatchParams(Product $product, array $data) : void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], [
                'value' => $param['value']
            ]);
        }
    }

    public static function syncBatchParams(Product $product, array $data) : void
    {
        $product->params()->detach();
        ProductService::attachBatchParams($product, $data);
    }

    public static function replicate(Product $product) : Product
    {
        try {
            DB::beginTransaction();

            $cloneProduct = $product->replicate();
            $cloneProduct->article = fake()->randomNumber(7);
            $cloneProduct->parent_id = $product->id;
            $cloneProduct->push();

            ImageService::replicateBatch($product, $cloneProduct);
            ParamProductService::replicateBatch($product, $cloneProduct);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, "Replicate transaction failed");
        }

        return $cloneProduct;
    }
}
