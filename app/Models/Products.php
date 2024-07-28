<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'name',
        'image',
        'description',
        'price',
        'stock_qty',
    ];
    public function supplier(){
        return $this->belongsTo(Suppliers::class);
    }
    public function orders(){
        return $this
        ->belongsToMany(Orders::class, 'order_details', 'product_id', 'order_id')
        ->withPivot('price', 'qty');
    }
}
