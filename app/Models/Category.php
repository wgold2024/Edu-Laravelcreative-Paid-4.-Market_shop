<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    protected $with = ['parent', 'children'];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function paramProducts() : HasManyThrough
    {
        return $this->hasManyThrough(ParamProduct::class, Product::class, 'category_id', 'product_id', 'id', 'id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->without('parent');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->without('children');
    }
}
