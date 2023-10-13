<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'discount',
        'original_price', // Voeg dit veld toe
        'leiding',
        'active',
        'category_id',
    ];

    public function getPriceWithDiscountAttribute()
    {
        if ($this->discount > 0) {
            $discountedPrice = $this->price - ($this->price * ($this->discount / 100));
            return number_format($discountedPrice, 2); // Als je de prijs wilt formatteren naar twee decimalen
        }

        return number_format($this->price, 2); // Als er geen korting is, retourneer de normale prijs
    }

    // public function getPriceAttribute($value)
    // {
    //     // Als er een kortingspercentage is, bereken de prijs na korting
    //     if ($this->discount > 0) {
    //         $discountedPrice = $value - ($value * ($this->discount / 100));
    //         return number_format($discountedPrice, 2);
    //     }

    //     return number_format($value, 2);
    // }



    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
