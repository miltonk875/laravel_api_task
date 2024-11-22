<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use HasFactory;

    protected $fillable = ['name', 'slug', 'price'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class);
    }

    public function orders() {
        return $this->hasMany(OrderDetail::class);
    }
}
