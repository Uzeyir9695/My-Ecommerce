<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory, HasUuids;

   protected $fillable = ['user_id', 'product_id'];

   public function product()
   {
       return $this->belongsTo(Product::class);
   }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
