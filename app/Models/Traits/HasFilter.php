<?php

namespace App\Models\Traits;

use App\Http\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, $data) : Builder
    {
        $className = 'App\\Http\\Filters\\' . class_basename($this) . 'Filter';
        $filter = new $className();

        return $filter->apply($builder, $data);
    }
}
