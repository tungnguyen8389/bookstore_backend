<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'cover_image',
        'price',
        'description',
        'stock',
    ];

    // Mot so san pham thuoc nhieu danh muc
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    // Mot so san phan thuoc nhieu muc gio hang
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product');
    }
    // Mot so san pham thuoc nhieu don hang
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
