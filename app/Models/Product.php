<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuids;

    protected $fillable = ['user_id', 'store_id', 'subcategory_id', 'name', 'price', 'quantity', 'description', 'discount'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
