<?php

namespace App\Services;

use App\Models\Param;
use Illuminate\Support\Collection;

class ParamService
{
    public static function store(array $data) : Param
    {
        return Param::create($data);
    }

    public static function update(array $data, Param $param) : Param
    {
        $param->update($data);

        return $param->fresh();
    }

    public static function indexByCategories(Collection $categoryChildren) : Collection
    {
        $arr = [];
        foreach ($categoryChildren->load('paramProducts')->pluck('paramProducts') as $paramProduct) {
            $arr = array_merge($arr, $paramProduct->toArray());
        }
        $arr = Collect($arr);
        $params = Param::whereIn('id', $arr->pluck('param_id')->unique())->get();
        $arr = $arr->groupBy('param_id');

        foreach ($params as $param) {
            $param->param_values = $arr[$param->id]->unique('value')->sortBy('value')->pluck('value')->toArray();
        }

        return $params;
    }
}
