<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = ['product_id', 'name', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
