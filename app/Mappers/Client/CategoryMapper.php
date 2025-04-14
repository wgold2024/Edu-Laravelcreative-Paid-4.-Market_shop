<?php

namespace App\Mappers\Client;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ParamService;
use App\Services\ProductService;

class CategoryMapper
{
    public static function productIndex(Category $category, array $data): array
    {
        $categoryTreeChildren = CategoryService::getCategoryChildren($category);
        $params = ParamService::indexByCategories($categoryTreeChildren);

        return [
            'products' => ProductResource::collection(ProductService::indexByCategories($categoryTreeChildren, $data))->resolve(),
            'params' => ParamWithValuesResource::collection($params)->resolve(),
            'breadCrumbs' => CategoryResource::collection(CategoryService::getCategoryParents($category))->resolve(),
            'categoryChildren' => CategoryResource::collection($category->children)->resolve(),
            'category' => CategoryResource::make($category)->resolve(),
        ];
    }

    public static function productIndexAsJson(Category $category, array $data): array
    {
        $categoryTreeChildren = CategoryService::getCategoryChildren($category);

        return [
            'products' => ProductResource::collection(ProductService::indexByCategories($categoryTreeChildren, $data))->resolve(),
        ];
    }
}
