<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductGroup extends Model
{
    protected $table = 'product_groups';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->whereNotNull('parent_id');
    }
}
