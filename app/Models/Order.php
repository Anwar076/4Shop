<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'email',
        'speltak',
        'amount',
        'mollie_id',
        'payed',
        'delivered', // Voeg delivered toe aan de lijst van massaal toegewezen velden
    ];

    public function rules()
    {
        return $this->hasMany(Order_rule::class);
    }
}
