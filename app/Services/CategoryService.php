<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    public static function store(array $data) : Category
    {
        return Category::create($data);
    }

    public static function update(array $data, Category $category) : Category
    {
        $category->update($data);

        return $category->fresh();
    }

    public static function getCategoryChildren(Category $category) : Collection
    {
        $collection = collect([]);
        $categoryChildren = Category::where('parent_id', $category->id)->get();

        foreach ($categoryChildren as $categoryChild) {
            $collection = $collection->merge(self::getCategoryChildren($categoryChild));
        }

        $collection->push($category);

        return $collection;
    }

    public static function getCategoryParents(Category $category) : Collection
    {
        $collection = collect([]);

        if ($category->parent_id) {
            $parentCategory = Category::find($category->parent_id);
            $collection->push($parentCategory);
            $collection = $collection->merge(self::getCategoryParents($parentCategory));
        }

        return $collection->reverse();
    }
}
