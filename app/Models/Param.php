<?php

namespace App\Models;

use App\Enums\Param\ParamFilterTypeEnum;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\String_;

class Param extends Model
{
    public function getFilterTypeTitleAttribute() : String
    {
        return ParamFilterTypeEnum::map()[$this->filter_type];
    }
}
