<?php

namespace App\Services;

use App\Models\ProductGroup;

class ProductGroupService
{
    public static function store(array $data) : ProductGroup
    {
        return ProductGroup::create($data);
    }

    public static function update(array $data, ProductGroup $productGroup) : ProductGroup
    {
        $productGroup->update($data);

        return $productGroup->fresh();
    }
}
