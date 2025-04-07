<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParamProduct extends Model
{
    protected $table = 'param_product';

    public function param(): BelongsTo
    {
        return $this->belongsTo(Param::class);
    }

    public function getTitleAttribute(): string
    {
        return $this->param->title;
    }

    public function scopeGroupedByParams(Builder $builder, Product $product): Builder
    {
        return ParamProduct::whereIn('product_id', $product->siblingProducts->pluck('id'))->with('param');
    }
}
