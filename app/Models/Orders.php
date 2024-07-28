<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillbale = [
        'customer_id',
        'total_amout'
    ];
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d/m/Y H:i:s'),
        );
    }
    public function customer(){
        return $this->belongsto(Customers::class);
    }
    public function details(){
        return $this
        ->belongstoMany(Products::class, 'order_detals', 'order_id', 'product_id')
        ->withPivot('price', 'stock_qty');
    }

}
