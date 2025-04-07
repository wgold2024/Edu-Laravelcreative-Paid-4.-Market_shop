<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Category\ProductIndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Param;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ParamService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use mysql_xdevapi\Collection;

class CategoryController extends Controller
{
    public function index() {
        $categories = CategoryResource::collection(Category::whereNull('parent_id')->get())->resolve();

        return \inertia('Client/Category/Index', compact('categories'));
    }

    public function productIndex(Category $category, ProductIndexRequest $request) {
        $data = $request->validated();

        $categoryTreeChildren = CategoryService::getCategoryChildren($category);
        $params = ParamService::indexByCategories($categoryTreeChildren);

        $products = ProductResource::collection(ProductService::indexByCategories($categoryTreeChildren, $data))->resolve();

        if ($request->wantsJson()) {
           return $products;
        }

        $params = ParamWithValuesResource::collection($params)->resolve();

        $breadCrumbs = CategoryResource::collection(CategoryService::getCategoryParents($category))->resolve();

        $categoryChildren = CategoryResource::collection($category->children)->resolve();
        $category = CategoryResource::make($category)->resolve();

        return inertia('Client/Category/ProductIndex', compact('category', 'products', 'breadCrumbs', 'params', 'categoryChildren'));
    }
}
