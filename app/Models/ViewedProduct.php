<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewedProduct extends Model
{
    protected $table = 'viewed_products';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static function view($product)
    {
        if (auth()->check()) {
            $viewed = ViewedProduct::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();
            if ($viewed) {
                $viewed->increment('view_numbers');
                return;
            }
            ViewedProduct::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
        }
    }
}
