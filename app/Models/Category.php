<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function paramProducts() : HasManyThrough
    {
        return $this->hasManyThrough(ParamProduct::class, Product::class, 'category_id', 'product_id', 'id', 'id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
