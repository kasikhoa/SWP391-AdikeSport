<?php
namespace App\Services;

use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
// use App\Models\ReviewImage;
use App\Models\SubCategory;
use App\Models\ProductImage;

class ImageServices
{
    public static function deleteImages($item)
    {
        if ($item instanceof Category) {
            return self::deleteImagesByCategory($item);
        } elseif ($item instanceof SubCategory) {
            return self::deleteImagesBySubCategory($item);
        } elseif ($item instanceof Size || $item instanceof Color) {
            return self::deleteImagesByAttribute($item);
        }
        self::deleteImagesByProduct($item);
    }

    public static function deleteImagesByAttribute($item)
    {
        foreach ($item->attributes as $attribute) {
            ProductImage::deleteItem($attribute);
        }
    }
    public static function deleteImagesByProduct($item)
    {
        // foreach ($item->attributes as $attribute) {
            ProductImage::deleteItem($item);
        // }
    }

    public static function deleteImagesBySubCategory($subCategory)
    {
        $subCategory->load('products');
        foreach ($subCategory->products as $product) {
            self::deleteImagesByProduct($product);
        }
    }

    public static function deleteImagesByCategory($category)
    {
        delete_file($category->image_path);
        $category->load('subcategories');
        foreach ($category->subcategories as $subCategory) {
            self::deleteImagesBySubCategory($subCategory);
        }
    }
}
