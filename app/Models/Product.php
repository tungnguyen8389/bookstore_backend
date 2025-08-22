<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'cover_image', 'price', 'stock', 'publication_year', 'publisher_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
