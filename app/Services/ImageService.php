<?php

namespace App\Services;

use App\Models\Param;
use App\Models\Product;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function storeBatch(Product $product, array $data) : void
    {
        foreach ($data['images'] as $image) {
            $product->images()->create([
                'path' => Storage::disk('public')->put('/images', $image),
            ]);
        }
    }

    public static function destroy($image) : void {
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }
}
