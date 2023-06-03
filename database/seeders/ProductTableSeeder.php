<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory()->count(50)->create();
        foreach($products as $product){
            if($product->id%2!=0) continue;
            $product->addMedia(public_path('/seeder-media/my-product.png'))->preservingOriginal()->toMediaCollection('productImages');
        }
        foreach($products as $product){
            if($product->id%2==0) continue;
            $product->addMedia(public_path('/seeder-media/product.png'))->preservingOriginal()->toMediaCollection('productImages');
        }

    }
}
