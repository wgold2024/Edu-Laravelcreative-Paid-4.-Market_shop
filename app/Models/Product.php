<?php

namespace App\Models;

use App\Http\Filters\ProductFilter;
use App\Models\Traits\HasFilter;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFilter;
    public function images() {
        return $this->hasMany(Image::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }

    public function siblingProducts(): HasMany
    {
        return $this->parent->children()->whereNot('id', $this->id);
    }

    public function productGroup(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }

    public function getGroupProductsAttribute(): Collection
    {
        return $this->productGroup->products()->whereNot('parent_id', $this->parent_id)->distinct('parent_id')->get();
    }

    public function params(): BelongsToMany
    {
        return $this->belongsToMany(Param::class)->withPivot('value');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function children() : HasMany
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public function getPreviewImageUrlAttribute() : Null|String
    {
        return $this->images()->first()->url ?? null;
    }

    public function scopeByCategories(Builder $builder, Collection $categoryChildren) {
        return $builder->whereIn('category_id', $categoryChildren->pluck('id'))
            ->whereNotNull('parent_id');
    }

    public function paramProducts() : HasMany
    {
        return $this->hasMany(ParamProduct::class, 'product_id', 'id');
    }

    public function getHasChildrenAttribute() : bool
    {
        return $this->children()->exists();
    }

    public function getGroupedParamsAttribute() : array
    {
        return $this->params->groupBy('title')->map(function  ($param) {
            return [
                'title' => $param->first()->title,
                'label' => $param->first()->label,
                'values' => $param->pluck('pivot.value')->toArray(),
            ];
        })->values()->toArray();
    }
}
