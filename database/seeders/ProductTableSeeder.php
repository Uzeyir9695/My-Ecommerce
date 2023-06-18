<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Store;
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
        $subcategories = Subcategory::all();
      // create 6 products for each subcategory
        foreach ($subcategories as $subcategory) {
            $products = Product::factory()->count(6)->create([
                'store_id' => Store::pluck('id')->random(),
                'subcategory_id' => $subcategory->id,
            ]);

            // get attributes for each subcategory
            $attributes = $subcategory->attributes()->get()->groupBy(function($data) {
                return $data->name;
            });

            // attach attributes to each product
            foreach($products as $product){

                foreach ($attributes as $name => $values) {
                    $attrName = $name;
                    $randomValue = $values->random()->value;
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'name' => $attrName,
                        'value' => $randomValue
                    ]);
                }

                // assign image to each productsssss
                if($product->id%2!=0) continue;
                $product->addMedia(public_path('/seeder-media/my-product.png'))->preservingOriginal()->toMediaCollection('productImages');
            }

            // assign image to each productsssss
            foreach($products as $product){
                if($product->id%2==0) continue;
                $product->addMedia(public_path('/seeder-media/product.png'))->preservingOriginal()->toMediaCollection('productImages');
            }
        }
    }
}
